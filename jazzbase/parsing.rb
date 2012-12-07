require 'nokogiri'
require 'open-uri'
require "yaml"

=begin 

  todo:        
    # download singer image
    # download album image
    # make increment site parsing to xml file
    # make create xml nodes from objects    
    # save id from jazzbase and meka own ids
    # switch to yaml
  done:
    # refactor loading of Singer (throught link in constructor)
    # output to XML

=end

XML_BASE = 'jazzbase.xml'
YAML_BASE = 'jazzbase.yml'

class Singers
  include Enumerable
  
  def self.load(file)
    if File.file?(file)
      f = open(file)
      return YAML::load(f)
    else
      nil
    end
  end

  def initialize(file)
    @singers = Array.new      
  end

  def each(&block)
    @singers.each(&block)  
  end 

  def push(singer)
    @singers.push singer
  end

  def [] index
    return @singers[index]
  end

end

class Singer
  
  def initialize(link)
      xPath = '/html/body/table/tr[3]/td[2]/table'

      doc = Nokogiri::HTML(open(link))
      
      @name = doc.xpath(xPath + '/tr[1]/td/h3')[0].content      
      @link = link   
        
      imgNode = doc.xpath(xPath + '/tr[2]/td/table/td/img')[0]
      if imgNode
        @img = imgNode[:src].to_s.subLink      
      end

      @styles = Array.new
      doc.xpath(xPath + '/tr[2]/td/table/td[2]/ul[3]/li/a').each do |el|
        @styles.push(el.content)
      end

      descrNode = doc.xpath(xPath + '/tr[3]/td/pre')[0]
      if descrNode
        @descr = descrNode.content     
      end
      
      @albums = Array.new
      doc.xpath(xPath + '/tr[2]/td/table/td[2]/ul[1]/li/a').each do |el|
        @albums.push(Album.new(el[:href].subLink))
      end                      
  end

  def to_s
    return @name + " [" + @link + "]: img = " + @img
  end

  attr_reader :name, :link, :descr, :img, :albums, :styles
end

class Album
  
  def initialize(link)
    xPath = '/html/body/table/tr[3]/td[2]/table'
    
    doc = Nokogiri::HTML(open(link))

    @name = doc.xpath(xPath + '/tr[1]/td/h3')[0].content

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
      @descr = descrNode.content
    end
  end

  def to_s
    return @name + " [" + @year + "]: img = " + @img
  end

  attr_reader :name, :year, :img, :descr
end

class String

  def subLink
    return gsub('../', 'http://jazzbase.ru/')
  end

end


def makeXML(singers)
  doc = Nokogiri::XML::Document.new()
  root = doc.create_element "jazzbase"
  doc.add_child root
  singers.each do |singer|
    singerNode = doc.create_element "singer"
    root.add_child singerNode

    singerNode['name'] = singer.name
    singerNode['img'] = singer.img

    descrNode = doc.create_element "description"
    singerNode.add_child descrNode
    descrNode.content = singer.descr

    stylesNode = doc.create_element "styles"
    singerNode.add_child stylesNode

    singer.styles.each do |style|
      styleNode = doc.create_element "style"
      stylesNode.add_child styleNode
      styleNode.content = style
    end

    albumsNode = doc.create_element "albums"
    singerNode.add_child albumsNode

    singer.albums.each do |album|
      albumNode = doc.create_element "album"
      albumsNode.add_child albumNode
      albumNode['name'] = album.name
      albumNode['year'] = album.year
      albumNode['img'] = album.img
      albumNode.content = album.descr
    end    
  end  
  
  File.open(XML_BASE, 'w') do |f|
    f.puts doc.to_xml(:encoding => 'UTF-8')      
  end

  doc.to_s  
end

def parseSingers
    uri = 'http://jazzbase.ru/people/765.htm'   
    doc = Nokogiri::HTML(open(uri)) 

    singers = Singers.load(YAML_BASE)
    puts singers[0]
    puts singers[0].descr

    singers = Array.new
    i = 0
    doc.css('ul#ispol li a').each do |link|         
        singer = Singer.new(link[:href].subLink)
        singers.push singer
        puts i.to_s + " " + singer.name
        i += 1        
        break
    end 
    return singers
end

#singer = Singer.new('http://jazzbase.ru/people/3544.htm')
# singer = Singer.new('http://jazzbase.ru/people/11805.htm')
# puts singer
singers = parseSingers
puts 'Length of singers array: ' + singers.length.to_s
#puts singers[0].styles
#puts arr[0].albums
#puts makeXML(singers)

# File.open(YAML_BASE + '.yml', 'w') do |f|
#   f.puts singers.to_yaml      
# end  

