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
        //usort( $data, array( &$this, 'usort_reorder' ) );

        $perPage = 10;
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
            'name'  => 'نام',
            'phone' => 'تلفن',
            'value' => 'مبلغ اهدایی',
            'project_id' => 'پروژه',
            'status' => 'وضعیت',
            'date_created' => 'تاریخ',
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

        if(isset($_GET['action'])) {
            $action = $_GET['action'];
            if ($action == 'delete') {
                $item = intval($_GET['item']);
                if ($item > 0) {
                    $wpdb->delete($wpdb->prefix . 'projects_donors', ['ID' => $item]);
                }
            }

        }

        $query = "SELECT * FROM {$wpdb->prefix}projects_donors ORDER BY id  DESC";
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

        //Build row actions
        $actions = array(
           'delete'    => sprintf('<a href="%s">حذف</a>',add_query_arg(['action'=>'delete','item'=>$item['id']])),
        );


        switch($column_name){
            case 'name':
                $delete_nonce = wp_create_nonce();
                $title = '<strong>' . $item['name'] . '</strong>';
                return $title. $this->row_actions( $actions );
            case 'phone':
            case 'value':
            case 'date_created':
                return $item[$column_name];
            case 'project_id':
                return  get_the_title($item[$column_name]);
            case 'status':
                echo (" تراکنش:".$item['trans_id']."<br>");
                switch($item[$column_name])
                    {
                        case '-1' : return '<p style="color: #f61818">خطا</p>';
                        case '-2' : return '<p style="color: #636363">در انتظار پرداخت</p>';
                        case '0' : return '<p style="color: #f67818">خطا یا انصراف</p>';
                        case '1' : return '<p style="color: #75f107">موفق</p>';
                        default : return '<p style="color: #f618bf">خطای نامشخص</p>';
                    }

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







}
