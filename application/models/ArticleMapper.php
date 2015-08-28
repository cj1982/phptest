<?php

class Model_ArticleMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Model_DbTable_Article');
        }
        return $this->_dbTable;
    }

    public function save(Model_Article $article)
    {
        $data = array(
            'name'   => $article->getName(),
            'email'   => $article->getEmail(),
            'text' => $article->getText(),
            'created' => date('Y-m-d H:i:s')
        );
      
        if (0 === $article->getId()) {
            unset($data['id']);
          $id =  $this->getDbTable()->insert($data);
        } else {
            $id = $this->getDbTable()->update($data, array('id = ?' => $article->getId()));
        }
        
        return  $id;
    }

    public function find($id, Model_Article $article)
    {
 
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        
        $row = $result->current();
       
        $article->setId($row->id)
                ->setEmail($row->email)
                ->setText($row->text)
                ->setName($row->name);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Model_Article();
            $entry->setId($row->id)
                  ->setEmail($row->email)
                  ->setText($row->text)
                  ->setName($row->name)
                  ->setCreated($row->created);
            $entries[] = $entry;
        }

        return $entries;
    }
    
    public function fetchAllPagination()
    {
    	$resultSet = $this->getDbTable()
    	                   ->select();
    	
    	return $resultSet;
    }
    
    
    public function delete($id)
    {
        $where = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $id);
    	$resultSet = $this->getDbTable()->delete($where);
    }
}

