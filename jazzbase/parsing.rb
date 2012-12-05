require 'nokogiri'
require 'open-uri'

=begin 
  
  todo:    
    # output to XML
    # download singer image
    # download album image
  
  done:
    # refactor loading of Singer (throught link in constructor)

=end

class Singer
  
  def initialize(link)
      doc = Nokogiri::HTML(open(link))
      @link = link

      xPath = '/html/body/table/tr[3]/td[2]/table'

      @name = doc.xpath(xPath + '/tr[1]/td/h3')[0].content      
      @descr = doc.xpath(xPath + '/tr[3]/td/pre')[0].content     
      @img = doc.xpath(xPath + '/tr[2]/td/table/td/img')[0][:src].to_s.subLink      
      @albums = Array.new
      doc.xpath(xPath + '/tr[2]/td/table/td[2]/ul[1]/li/a').each do |el|
        @albums.push(Album.new(el[:href].subLink))
      end                
      
  end

  def to_s
    return @name + " [" + @link + "]: img = " + @img
  end

  attr_reader :name, :link, :descr, :img, :albums  
end

class Album
  
  def initialize(link)
    doc = Nokogiri::HTML(open(link))

    xPath = '/html/body/table/tr[3]/td[2]/table'

    @name = doc.xpath(xPath + '/tr[1]/td/h3')[0].content
    @year = doc.xpath(xPath + '/tr[2]/td/table/td[2]/ul[2]/li/a')[0].content    
    @img = doc.xpath(xPath + '/tr[2]/td/table/td[1]/img')[0][:src].subLink
    @descr = doc.xpath(xPath + '/tr[3]/td/pre')[0].content
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

def parseSingers
    uri = 'http://jazzbase.ru/people/765.htm'   
    doc = Nokogiri::HTML(open(uri)) 

    arr = Array.new
    doc.css('ul#ispol li a').each do |link| 
        arr.push Singer.new(link[:href].subLink)
        break
    end 
    return arr
end

arr = parseSingers
puts 'Length of singers array: ' + arr.length.to_s
puts arr[0]
puts arr[0].albums