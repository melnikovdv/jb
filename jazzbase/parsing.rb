require 'nokogiri'
require 'open-uri'

class Singer
    def initialize(name, link)
        @name = name
        @link = link
    end
    def to_s
        return @name + " [" + @link + "]"
    end
    attr_reader :name, :link
    attr_accessor :descr, :imgTag
end


def parseSingers
    uri = 'http://jazzbase.ru/people/765.htm'   
    doc = Nokogiri::HTML(open(uri)) 

    arr = Array.new
    doc.css('ul#ispol li a').each do |link| 
        arr.push Singer.new(link.content, link[:href].gsub('../', 'http://jazzbase.ru/'))               
        break
    end 
    return arr
end

def parseSingerDescription(singer)
  doc = Nokogiri::HTML(open(singer.link))     
  singer.descr = doc.xpath('//html/body/table/tr[3]/td[2]/table/tr[3]/td/pre')[0].content     
  singer.imgTag = doc.xpath('//html/body/table/tr[3]/td[2]/table/tr[2]/td/table/td/img')[0].to_s.gsub('../', 'http://jazzbase.ru/')

  puts doc.xpath('/html/body/table/tr[3]/td[2]/table/tr[2]/td/table/tr/td[2]/ul[1]//li')[0].content
  #               /html/body/table/tr[3]/td[2]/table/tr[2]/td/table/tr/td[2]/ul[1]
  doc.xpath('/html/body/table/tr[3]/td[2]/table/tr[2]/td/table/tr/td[2]/ul[1]//li').each do |el|
  	puts el.class
  end

#tr[3]/td[2]/table/tr[2]/td/table/tr/td[1]/img
  # f = File.new("settings.txt", "w")
  # f.write s
  # f.close
end
arr = parseSingers
puts 'Length of singers array: ' + arr.length.to_s
#puts arr[0]
puts arr[0].link
parseSingerDescription(arr[0])
# puts arr[0].descr
# puts arr[0].imgTag