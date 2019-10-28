<?php


class Paginator
{
    private $_conn;
    private $_limit = 10;
    private $_page;
    private $_query;
    public $total;
    private $_base_path;

    /**
     * Paginator constructor.
     * @param PDO $conn - Database connector class.
     * @param string $query - Base query.
     * @param string $base_path - Base URL (e.g. /products)
     */
    public function __construct($conn, $query, $base_path = '')
    {
        $this->_conn = $conn;
        $this->_query = $query;
        $this->_base_path = $base_path;

        $res = $this->_conn->query($this->_query);

        $this->total = $res->rowCount();
    }

    /**
     * Get data
     * @param int $page
     * @return stdClass
     */
    public function getData($page = 1)
    {
        $this->_page = $page;

        $query = $this->_query . " LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";

        $res = $this->_conn->query($query);

        $results = null;
        while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            $results[] = $row;
        }

        $result = new stdClass();
        $result->page = $this->_page;
        $result->total = $this->total;
        $result->data = $results;

        return $result;
    }

    public function createLinks($list_class = 'pagination')
    {
        if ($this->_limit == 'all') {
            return '';
        }

        $last = ceil($this->total / $this->_limit);

        $start = 1;
        $end = $last;

        $html = '<ul class="' . $list_class . '">';

        $class = ($this->_page == 1) ? "disabled" : "";
        $html .= '<li class="page-item ' . $class . '"><a class="page-link" href="' . $this->_base_path . '?page=' . ($this->_page - 1) . '">Prev</a></li>';

        if ($start > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->_base_path . '?page=1">1</a></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ($this->_page == $i) ? "active" : "";
            $html .= '<li class="page-item ' . $class . '"><a class="page-link" href="' . $this->_base_path . '?page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->_base_path . '?page=' . $last . '">' . $last . '</a></li>';
        }

        $class = ($this->_page == $last) ? "disabled" : "";
        $html .= '<li class="page-item ' . $class . '"><a class="page-link" href="' . $this->_base_path . '?page=' . ($this->_page + 1) . '">Next</a></li>';

        $html .= '</ul>';

        return $html;
    }
}
