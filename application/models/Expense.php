<?php

class Expense extends CI_Model
{
    public function index()
    {
        $response = array(
            'total' => 5,
            'data' => array(
                array(
                    'id' => '5',
                    'title' => 'Test Expense 5',
                    'amount' => '1505',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'date_created' => '2014-10-31 11:55:07',
                    'date_updated' => NULL
                ),
                array(
                    'id' => '4',
                    'title' => 'Test Expense 4',
                    'amount' => '1404',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'date_created' => '2014-10-31 11:54:49',
                    'date_updated' => NULL
                )
            )
        );
        
        return json_encode($response);
    }
    
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