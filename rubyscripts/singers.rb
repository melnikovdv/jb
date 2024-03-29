# encoding: utf-8

require 'nokogiri'
require 'open-uri'
require 'yaml'

=begin 

  todo:        
    # download singer's images and album's images
    # refactor plain parsing procedure to Singers class
  done:
    # switch to yaml
    # make increment site parsing to file
    # save id from jazzbase
    # refactor loading of Singer (throught link in constructor)
    # output to XML

=end

YAML_BASE = 'jazzbase.yml'

class Singers
  include Enumerable
  
  def self.parse
    uri = 'http://jazzbase.ru/people/765.htm'   
    doc = Nokogiri::HTML(open(uri)) 

    singers = Singers.restore(YAML_BASE)
    if !singers
      puts 'new Singers class created'
      singers = Singers.new
    end

    i = 0
    doc.css('ul#ispol li a').each do |link|         
      singerLink = link[:href].subLink
      id = singerLink.jazzbaseId
      singer = singers.byId(id)

      if !singer
        singer = Singer.new singerLink
        singers.push singer
        puts i.to_s + ". " + singer.id + ' ' + singer.name + ' was added as new'        
        if i % 100 == 0
          Singers.store(singers, YAML_BASE)
        end
      else        
        puts i.to_s + ". " + singer.id + ' ' + singer.name + ' was already in the base'
        if !singer.loaded?
          singers.delete singer 
          singer = Singer.new singerLink
          singers.push singer
          puts 'not loaded'
        end  
        singer.checkAlbumsForNew
      end 
      
      i += 1          
    end 
    Singers.store(singers, YAML_BASE)
    return singers    
  end

  def self.store(singers, file)
    time = Time.new
    puts 'saving to file started at ' + time.inspect 
    File.open(file, 'w') do |f|
      f.puts singers.to_yaml
    end
    time = Time.new
    puts 'saving to file finished at ' + time.inspect
  end

  def self.restore(file)
    puts File.extname(file)
    if File.file?(file)
        p 'file ' + file + ' found'
        f = open(file)
        return YAML::load(f)
    else
      p 'file ' + file + ' not found'
      return nil
    end
  end  

  def initialize()
    @singers = Array.new      
  end

  def each(&block)
    @singers.each(&block)  
  end 

  def push(singer)
    @singers.push singer
  end

  def delete(singer)
    @singers.delete singer
  end

  def length
    return @singers.length
  end

  def [] index
    return @singers[index]
  end

  def byId(id) 
    @singers.each do |element|
      if element.id.eql?(id) 
        return element
      end 
    end
    return nil
  end
end

class Singer
  
  def initialize(link)
    @id = link.jazzbaseId

    xPath = '/html/body/table/tr[3]/td[2]/table'

    doc = Nokogiri::HTML(open(link))
    
    @name = doc.xpath(xPath + '/tr[1]/td/h3')[0].content.encode('utf-8')       
    @link = link   
      
    imgNode = doc.xpath(xPath + '/tr[2]/td/table/td/img')[0]
    if imgNode
      @img = imgNode[:src].to_s.subLink      
    end


    @instruments = Array.new
    doc.xpath(xPath + '/tr[2]/td/table/td[2]/h4').each do |el|
      if el.content.eql?('Инструменты')                
        el.next.next.xpath('li/a').each do |ael|          
          @instruments.push(ael.content.encode('utf-8'))
        end
      end
    end
    
    @styles = Array.new    
    doc.xpath(xPath + '/tr[2]/td/table/td[2]/h4').each do |el|
      if el.content.eql?('Стили')                
        el.next.next.xpath('li/a').each do |ael|          
          @styles.push(ael.content.encode('utf-8'))
        end
      end
    end

    @seealso = Array.new    
    doc.xpath(xPath + '/tr[2]/td/table/td[2]/h4').each do |el|
      if el.content.eql?('См. также')                
        el.next.next.xpath('li/a').each do |ael|          
          @seealso.push(ael[:href].jazzbaseId)
        end
      end
    end

    descrNode = doc.xpath(xPath + '/tr[3]/td/pre')[0]
    if descrNode
      @descr = descrNode.content.encode('utf-8')   
    end
    
    @albums = Array.new    
    doc.xpath(xPath + '/tr[2]/td/table/td[2]/h4').each do |el|
      if el.content.eql?('Альбомы и DVD')                
        el.next.next.xpath('li/a').each do |ael|          
          @albums.push(Album.new(ael[:href].subLink))
        end
      end
    end

    @loaded = true  
    @addedAsNew = true             
  end

  def checkAlbumsForNew
    xPath = '/html/body/table/tr[3]/td[2]/table'
    doc = Nokogiri::HTML(open(@link))
    doc.xpath(xPath + '/tr[2]/td/table/td[2]/h4').each do |el|
      if el.content.eql?('Альбомы и DVD')                
        el.next.next.xpath('li/a').each do |ael|          
          id = ael[:href].subLink.jazzbaseId
          hasAlbum = false
          @albums.each do |album|
            if album.id.eql?(id)
              hasAlbum = true
            end
          end
          unless hasAlbum
            albumNew = Album.new(ael[:href].subLink)
            albumNew.addedAsNew = true
            @albums.push(albumNew) 
          end
        end
      end  
    end
  end
  
  def loaded?
    return @loaded
  end

  def to_s
    return @id + ':' + @name + " [" + @link + "]: img = " + @img
  end

  attr_reader :id, :name, :link, :descr, :img, :albums, :styles, :instruments, :seealso
  attr_accessor :addedAsNew
end

class Album
  
  def initialize(link)
    @id = link.jazzbaseId

    @addedAsNew = false

    @dvd = false
    if link[/\/dvd\//]
      @dvd = true      
    end

    xPath = '/html/body/table/tr[3]/td[2]/table'
    
    doc = Nokogiri::HTML(open(link))

    @name = doc.xpath(xPath + '/tr[1]/td/h3')[0].content.encode('utf-8')

    yearNode = doc.xpath(xPath + '/tr[2]/td/table/td[2]/ul[2]/li/a')[0]
    if yearNode 
      @year = yearNode.content    
    end

    imgNode = doc.xpath(xPath + '/tr[2]/td/table/td[1]/img')[0]
    if imgNode
      @img = imgNode[:src].subLink
    end
    
    descrNode = doc.xpath(xPath + '/tr[3]/td/pre')[0]
    if descrNode
      @descr = descrNode.content.encode('utf-8')
    end
  end

  def to_s
    return @id + ':' + @name + " [" + @year + "]: img = " + @img
  end

  attr_reader :id, :name, :year, :img, :descr, :dvd
  attr_accessor :addedAsNew
end

class String

  def subLink
    return gsub('../', 'http://jazzbase.ru/')
  end

  def jazzbaseId
    return self[/(\d)+/]
  end

end