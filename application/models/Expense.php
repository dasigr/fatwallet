<?php

class Expense extends CI_Model
{
    /**
     * Generate a list of all expenses.
     *
     * @param int $offset
     * @param int $limit
     * @param string $orderBy
     * @param string $sort
     * @return mixed An array of Expense objects
     */
    public function getAll($params = array())
    {
        // Get parameters
        $offset = isset($params['offset']) ? $params['offset'] : 0;
        $limit = isset($params['limit']) ? $params['limit'] : 25;
        $orderBy = isset($params['orderBy']) ? $params['orderBy'] : 'date_created';
        $sort = isset($params['sort']) ? $params['sort'] : 'DESC';
        
        // Generate an SQL script
        $sql = "SELECT * FROM `expense` ORDER BY `" . $orderBy . "` " . $sort . " LIMIT " . $offset . ", " . $limit;
        
        // Execute query
        $query = $this->db->query($sql);
        
        // Construct result
        $result = array();
        foreach ($query->result() as $key => $row)
        {
            $result[$key] = $row;
        }
    
        return $result;
    }
}