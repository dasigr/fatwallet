<?php

class Photo {
    /**
     * read_list_by_album_sql()
     * 
     * @param int $user_id
     * @param int $album_id
     * @param int $offset
     * @param int $limit
     * @return string An sql statement
     */
    public function read_list_by_album_sql($user_id, $album_id, $offset, $limit)
    {
        $sql = "SELECT * FROM `uploads`";
        return $sql;
    }
    
    /**
     * delete_sql()
     * 
     * @param int $photo_id
     * $return string An sql statement
     */
    public function delete_sql($photo_id)
    {
        $sql = "DELETE FROM `uploads` WHERE `id`='" . $photo_id ."'";
        
        return $sql;
    }
}

class SomeTest extends AbstractDatabaseTestCase {
    
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    /**
     * test_read_list_by_album_sql()
     * 
     * @return void
     */
    public function test_read_list_by_album_sql()
    {
        $photo = new Photo();
        
        // Set parameters
        $user_id = 1;
        $album_id = 1;
        $offset= 0;
        $limit = 6;
        
        // Act
        $sql = $photo->read_list_by_album_sql($user_id, $album_id, $offset, $limit);
        
        // Execute the query
        $queryTable = $this->getConnection()->createQueryTable('uploads', $sql);
        
        // Get expected result
        $expectedTable = $this->createFlatXmlDataSet(dirname(__FILE__).'/seeds/photos.xml')->getTable("uploads");
        
        // Assert
        $this->assertTablesEqual($expectedTable, $queryTable);
    }
    
    /**
     * test_delete_sql()
     * 
     * @return void
     */
    public function test_delete_sql()
    {
        // Get current number of photos in db.
        $this->assertEquals(3, $this->getConnection()->getRowCount('uploads'), "Pre-Condition");
        
        // Act
        $photo = new Photo();
        $photo_id = 19;
        $sql = $photo->delete_sql($photo_id);
        $queryTable = $this->getConnection()->createQueryTable('uploads', $sql); // @todo: fails deleting a photo
        
        // Assert
        $this->assertEquals(2, $this->getConnection()->getRowCount('uploads'), "Inserting failed");
    }
}