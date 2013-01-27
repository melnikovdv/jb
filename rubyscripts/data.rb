require './singers'
require 'mysql'

DB_HOST = '127.0.0.1'
DB_USER = 'root'
DB_PASSWORD = 'root'
DB_NAME = 'test'

# DB_HOST = '127.0.0.1'
# DB_USER = 'dbu_mdv_3'
# DB_PASSWORD = 'JW98CWy9Hlc'
# DB_NAME = 'db_mdv_9'

# DB_HOST = '127.0.0.1'
# DB_USER = 'jazzbase_boogiewoogie_ru'
# DB_PASSWORD = '86artzRp'
# DB_NAME = 'jazzbase_boogiewoogie_ru'

FILENAME = YAML_BASE
# FILENAME = '26012013.yml'

class JazzbaseData
	def initialize()
    @connection = Mysql.connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
  end	

  def insert()
    singers = Singers.restore(FILENAME)
    stmt = @connection.query('set names utf8')
    # stmt.execute

    singers.each do |singer|
      if singerExists?(singer)        
        insertSingerSubData(singer)
      else
        insertSinger(singer)          
      end      

      singer.albums.each do |album|
        insertAlbums(singer, album)
      end      
    end
  end

  private 
  def insertSingerSubData(singer) 
    insertStyles(singer)
    insertInstruments(singer)
    insertSeeAlso(singer)
  end

  private
  def insertSinger(singer)
    stmt = @connection.prepare('insert into singers (sgr_id, sgr_name, sgr_descr) values (?,?,?)')  
    stmt.execute singer.id, singer.name, singer.descr    
    insertSingerSubData(singer)
  end

  private
  def insertAlbums(singer, album)
    stmt = @connection.prepare('insert into albums (jb_id, sgr_id, alb_type, alb_name, 
      alb_year, alb_descr) values (?,?,?,?,?,?)')    
    stmt.execute album.id, singer.id, album.dvd ? 1 : 0, album.name, album.year, album.descr
    stmt.close
  end

  private
  def singerAlbumExists?(singer, albumJbId)        
    stmt = @connection.prepare("select sgr_id from albums where jb_id = ? and sgr_id = ?")
    rs = stmt.execute albumJbId, sgr_id 
    rs.each do |fs|      
      if fs[0]
        return true          
      end
    end    
    stmt.close
    return false
  end

  private
  def insertStyles(singer)
    singer.styles.each do |style|        
      insertStyle(style) unless styleExists?(style)
      insertSingerStyle(singer, style)
    end
  end

  private
  def insertStyle(style)
    stmt = @connection.prepare('insert into styles (stl_name) values (?)')    
    stmt.execute style
    stmt.close
  end

  private
  def insertSingerStyle(singer, style)
    styleId = getStyleId(style);
    if styleId
      if !singerStyleExists?(singer, styleId)
        stmt = @connection.prepare('insert into singer_styles (sgr_id, stl_id) values (?,?)')          
        stmt.execute singer.id, styleId
        stmt.close
      end
    end
  end

  private
  def styleExists?(style)    
    stmt = @connection.prepare("select stl_name from styles where stl_name = ?")
    rs = stmt.execute style 
    rs.each do |fs|      
      if fs[0]
        return true          
      end
    end    
    stmt.close
    return false
  end

  private
  def singerStyleExists?(singer, styleId)        
    stmt = @connection.prepare("select sgr_id from singer_styles where stl_id = ? and sgr_id = ?")
    rs = stmt.execute styleId, singer.id
    rs.each do |fs|      
      if fs[0]
        return true          
      end
    end    
    stmt.close
    return false
  end

  private
  def singerExists?(singer)
    stmt = @connection.prepare("select sgr_id from singers where sgr_id = ?")
    rs = stmt.execute singer.id 
    rs.each do |fs|      
      if fs[0]
        return true          
      end
    end    
    stmt.close
    return false
  end

  private
  def getStyleId(style)
    stmt = @connection.prepare("select stl_id from styles where stl_name = ?")
    rs = stmt.execute style 
    rs.each do |fs|
      return fs[0]
    end        
    stmt.close  
  end

  private
  def insertInstruments(singer)
    singer.instruments.each do |instrument|        
      insertInstrument(instrument) unless instrumentExists?(instrument)
      insertSingerInstrument(singer, instrument)
    end
  end

  private
  def instrumentExists?(instrument)    
    stmt = @connection.prepare("select ins_name from instruments where ins_name = ?")
    rs = stmt.execute instrument 
    rs.each do |fs|      
      if fs[0]
        return true          
      end
    end    
    stmt.close
    return false
  end

  private
  def insertInstrument(instrument)
    stmt = @connection.prepare('insert into instruments (ins_name) values (?)')    
    stmt.execute instrument
    stmt.close
  end

  private
  def insertSingerInstrument(singer, instrument)
    insId = getInstrumentId(instrument);
    if insId      
      if !singerInstrumentExists?(singer, insId)
        stmt = @connection.prepare('insert into singer_instruments (sgr_id, ins_id) values (?,?)')
        stmt.execute singer.id, insId
        stmt.close
      end
    end
  end

  private
  def singerInstrumentExists?(singer, instrumentId)        
    stmt = @connection.prepare("select sgr_id from singer_instruments where ins_id = ? and sgr_id = ?")
    rs = stmt.execute instrumentId, singer.id
    rs.each do |fs|      
      if fs[0]
        return true          
      end
    end    
    stmt.close
    return false
  end

  private 
  def getInstrumentId(instrument)
    stmt = @connection.prepare("select ins_id from instruments where ins_name = ?")
    rs = stmt.execute instrument 
    rs.each do |fs|
      return fs[0]
    end          
    stmt.close
  end

  private
  def insertSeeAlso(singer)
    singer.seealso.each do |id|
      if !singerSeeAlsoExists?(singer, id)
        stmt = @connection.prepare("insert into singers_see_also (sgr_id, seealso_id) values (?,?)")
        stmt.execute singer.id, id
        stmt.close
      end
    end
  end

  private
  def singerSeeAlsoExists?(singer, id)        
    stmt = @connection.prepare("select sgr_id from singers_see_also where seealso_id = ? and sgr_id = ?")
    rs = stmt.execute id, singer.id
    rs.each do |fs|      
      if fs[0]
        return true          
      end
    end    
    stmt.close
    return false
  end


end
# @connection.query("select col1, col2 from tblname").each do |col1, col2|
#   p col1, col2
# end

data = JazzbaseData.new
data.insert
