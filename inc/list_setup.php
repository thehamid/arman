<?php





// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Example_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort( $data, array( &$this, 'usort_reorder' ) );

        $perPage = 20;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id'    => 'ردیف',
            'name'  => 'نام',
            'phone' => 'تلفن',
            'value' => 'مبلغ اهدایی',
            'project_id' => 'پروژه',
            'status' => 'وضعیت'
        );

        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('id' => array('id', true));
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
       global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}projects_donors";
        $data = $wpdb->get_results( $query, ARRAY_A );

        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch($column_name){
            case 'id':
            case 'name':
            case 'phone':
            case 'value':
            case 'status':
                return $item[$column_name];
            case 'project_id':
                return  get_the_title($item[$column_name]);
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }


    function usort_reorder($a,$b){
        $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id'; //If no sort, default to title
        $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'DESC'; //If no order, default to asc
        $result = strnatcmp($a[$orderby], $b[$orderby]); //Determine sort order
        return ($order==='DESC') ? $result : -$result; //Send final sort direction to usort
    }



    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'id';
        $order = 'dsc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'dsc')
        {
            return $result;
        }

        return -$result;
    }
}
?>