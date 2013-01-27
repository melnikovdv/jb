require './singers'
require "open-uri"

def downloadImage(url, fname)
  if url
    begin  
      open(url) {|f|        
        File.open(fname, "wb") do |file|
         file.puts f.read
        end        
      }
    rescue OpenURI::HTTPError => ex
      puts "Handle missing video here"
    end
  end
end

def downloadImages(singers)
  i = singers.length
  singers.each do |singer|
    id = singer.id
    url = singer.img

    file = 'images/' + id + '.jpg'
    if !File.file?(file)      
      downloadImage(url, file)        
    end    

    singer.albums.each do |album|
      album_id = album.id
      album_url = album.img
      #puts album_url
      file = 'images/' + id + '_' + album_id + '.jpg'
      if !File.file?(file)      
        downloadImage(album_url, file)
      end    
    end    
    i -= 1
    puts i.to_s + ' left'
  end
end

singers = Singers.restore('26012013.yml')
puts 'Length of singers array: ' + singers.length.to_s

downloadImages(singers)


  
