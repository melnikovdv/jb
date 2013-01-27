XML_BASE = 'jazzbase.xml'

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

require './singers'
#==========================================
# singers = Singers.restore(YAML_BASE)
# d = Hash.new(0)
# c = 0
# singers.each do |singer|
# #   d[singer.id] += 1
#   singer.albums.each do |album|
#     d[album.id] += 1
#     if d[album.id] > 1
#       puts 'singer = ' + singer.id + ' album = ' + album.id
#     end
#     c += 1
#   end
# end

# dc = 0
# d.each_pair do |key, value|

#   if value > 1
#     # puts 'key: ' + key.to_s + '; value = ' + value.to_s
#     dc += 1
#   end  
# end

# puts dc
# c = c + singers.length
# puts 'Total singers + albums = ' + c.to_s
#==========================================
singers = Singers.restore(YAML_BASE)
singersNew = Singers.new
len = 0
alb = 0
singers.each do |singer|
  if singer.addedAsNew
    singer.addedAsNew = false
    singersNew.push singer
  else 
    hasNewAlbum = false
    singer.albums.each do |album|            
      if album.addedAsNew
        hasNewAlbum = true                
      end      
      album.addedAsNew = false
    end      
    singersNew.push singer if hasNewAlbum
  end
end

fname = '26012013.yml'
Singers.store(singersNew, fname)
Singers.store(singers, YAML_BASE)
#==========================================
# fname = '26012013_2.yml'
# singers = Singers.restore(fname)
# count = 0
# dvdcount = 0
# singers.each do |singer|
#   if singer.addedAsNew
#     count += singer.albums.length
#   else 
#     singer.albums.each do |album|      
#       if album.addedAsNew
#         count += 1        
#       end
#     end              
#   end
# end

# singers.each do |singer|
#   singer.albums.each do |album|      
#     if album.dvd && album.addedAsNew
#       dvdcount += 1
#       p album.name
#     end
#   end
# end  
# p count
# p dvdcount