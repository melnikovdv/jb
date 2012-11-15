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

def parseSingerDescription(uri)
  doc = Nokogiri::HTML(open(uri))   
  doc.css('td.dbrd table').each do |el|    
    s = el.children[2].children[0].content
    puts s.class
    f = File.new("settings.txt", "w")
    f.write s
    f.close
    
    puts s.empty?
    #puts el.content
    #exit
  end
  #puts doc.class
  #puts doc.xpath('./html/body/table/tbody/tr[3]/td[2]/table/tbody/tr[3]/td/pre')
end

arr = parseSingers
puts 'Length of singers array: ' + arr.length.to_s

#puts arr[0]
puts arr[0].link
parseSingerDescription arr[0].link

