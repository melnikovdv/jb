require './singers'

singers = Singers.parse
puts 'Length of singers array: ' + singers.length.to_s

# s = Singer.new('http://www.jazzbase.ru/people/14800.htm')
# p s.styles
# File.open('s1', 'w') do |f|
#   f.puts s.to_yaml      
# end
# s = Singer.new('http://www.jazzbase.ru/people/27481.htm')
# p s.styles
# File.open('s2', 'w') do |f|
#   f.puts s.to_yaml      
# end

