require './singers'
require 'mysql'

DB_HOST = '127.0.0.1'
DB_USER = 'root'
DB_PASSWORD = 'root'
DB_NAME = 'test'

class JazzbaseData
	def initialize()
    @connection = Mysql.connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
  end	

  def insert()
    singers = Singers.restore(YAML_BASE)
    stmt = @connection.prepare('set names utf8')
    stmt.execute

    singers.each do |singer|
      insertSinger(singer)  
      singer.albums.each do |album|
        insertAlbums(singer, album)
      end
    end
  end

  private
  def insertSinger(singer)
    stmt = @connection.prepare('insert into singer (sgr_id, sgr_name, sgr_descr) values (?,?,?)')  
    stmt.execute singer.id, singer.name, singer.descr
  end

  private
  def insertAlbums(singer, album)
    stmt = @connection.prepare('insert into album (jb_id, sgr_id, alb_type, alb_name, 
      alb_year, alb_descr) values (?,?,?,?,?, ?)')    
    stmt.execute album.id, singer.id, album.dvd ? 1 : 0, album.name, album.year, album.descr
  end
end

# @connection.query("select col1, col2 from tblname").each do |col1, col2|
#   p col1, col2
# end

data = JazzbaseData.new
data.insert
