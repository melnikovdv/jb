require 'nokogiri'
require 'open-uri'

class Singer
	def initialize(name, link)
		@name = name
		@link = link
	end
	def to_s
		return @name + "[" + @link + "]"
	end
	attr_reader :name, :link
end


def parseSingers
	uri = 'http://jazzbase.ru/people/765.htm'	
	doc = Nokogiri::HTML(open(uri))	

	arr = Array.new
	doc.css('ul#ispol li a').each do |link| 
		arr.push Singer.new(link.content, link[:href].gsub('../', 'http://jazzbase.ru/'))		
	end	
	return arr
end

arr = parseSingers
puts arr[0]
puts 'Length of singers array: ' + arr.length.to_s
