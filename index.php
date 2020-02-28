<?php
/**
 * Plugin Name: Craw Post Data
 * Description: Craw data
 * Plugin URI: 
 * Author: Huynh Long
 * Version: 1.0.0
 * Author URI: 
 * Text Domain: ot
 */
define( 'OT_PATH', plugin_dir_path( __FILE__ ) );
define( 'OT_URL', plugins_url('/', __FILE__ ) );
class ot_main_craw_data{
    function __construct(){
        add_action( 'admin_menu', array( $this, 'ot_setting_menu') );
        add_action( 'wp_ajax_crawDataAjax', [$this,'crawDataAjax'] );
        add_action( 'wp_ajax_nopriv_crawDataAjax',  [$this,'crawDataAjax'] );
        add_action( 'admin_footer', [$this,'ot_craw_script'] );
        add_action( 'wp_ajax_addPostData', [$this,'addPostData'] );
        add_action( 'wp_ajax_nopriv_addPostData',  [$this,'addPostData'] );
        add_action( 'admin_head', [$this,'OtEnqueueScript'] );
    }
    function OtEnqueueScript(){
        wp_enqueue_style('craw-style', OT_URL . 'assets/css/style.css', array(), '1.0.0');
    }
    public function ot_setting_menu() {
        add_menu_page( esc_html__( 'OT Craw Data', 'ot' ), esc_html__( 'OT Craw Data', 'ot' ), 'manage_options', 'ot-page', array($this, 'ot_admin_page_contents'), 'dashicons-cloud', 300 );
    }
    public function ot_admin_page_contents() {
        require_once( OT_PATH.'/includes/craw.php' );
    }
    public function crawDataAjax(){
        echo file_get_contents($_GET['url']);
        die();
    }
    public function Generate_Featured_Image( $imgUrl, $post_id){
        $upload_dir = wp_upload_dir();
        $image_data = file_get_contents($imgUrl);
        $filename = basename($imgUrl);
        if(wp_mkdir_p($upload_dir['path']))
            $file = $upload_dir['path'] . '/' . $filename;
        else
            $file = $upload_dir['basedir'] . '/' . $filename;
        file_put_contents($file, $image_data);
        $wp_filetype = wp_check_filetype($filename, null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
        set_post_thumbnail( $post_id, $attach_id );
    }
    public function addPostData(){
        global $post;
        $post_id = wp_insert_post( array(
            'post_title'    => wp_strip_all_tags( $_POST['title'] ),     
            'post_content'  => (isset($_POST['content'])) ? $_POST['content'] : '',
            'post_status'   => 'pending', 
            'post_type'     => 'post'
        ) );
        if (isset($_POST['image'])){
            $imgUrl = $_POST['image'];
            $this->Generate_Featured_Image( $imgUrl,$post_id );
        }
        exit();
    }
    function ot_craw_script(){
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Show message
                function showMess(mess){
                    $('#mess').append(mess);
                }
                $('.form-craw').submit(function(event) {
                    event.preventDefault();
                    var field_per_page = $('.field_per_page').val();
                    var field_url1 = $('.field_url1').val();
                    var field_item1 = $('.field_item1').val();
                    var field_not_item = $('.field_not_item').val();
                    var field_perlink = $('.field_perlink').val();
                    var field_title = $('.field_title').val();
                    var field_image = $('.field_image').val();
                    var field_content = $('.field_content').val();
                    var field_pr = $('.field_pr').val();
                    // Page current
                    var currentPage = 1;
                    if (currentPage == 0){
                        currentPage = 1;
                    }
                    allItem = [];
                    savePageIndex = 0;

                    $('.demo').append('<iframe src="" width="100%" height="300"></iframe>');

                    function startAPage(){
                        allItem = [];
                        savePageIndex = 0;
                        // Save All posts in the page
                        // var page = '/page/'+currentPage;
                        /*
                        /page/1
                        ?page=1
                        */
                        var page = field_pr+currentPage;
                        var pa = $.trim(field_url1+page);
                        console.log('page',pa);
                        $.ajax({
                            url : "<?php echo admin_url('admin-ajax.php');?>",
                            data : {
                                url : pa,
                                action : 'crawDataAjax'
                            },
                            type : "get",
                            dataType:"text",
                            beforeSend: function( xhr ) {
                                $('.loading').addClass('active');
                            },                            
                            success : function(result){
                                var html = $.parseHTML(result);
                                var items = (field_not_item) ? $(html).find(field_item1).not( field_not_item ) : $(html).find(field_item1);
                                for (var i = 0; i <= items.length; i++){
                                    var html = $.parseHTML(result);
                                    var item = $(items[i]).find(field_perlink).attr('href');
                                    allItem.push(item);
                                }
                                // Start save post
                                if (allItem.length > 0 && currentPage <= field_per_page){
                                    savePage();
                                }
                                else {
                                    showMess('<span style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;border-radius: 4px;padding: 15px;display:block;">Success!</span>');
                                    $('.loading').removeClass('active');
                                }
                            }
                        });
                    }
                    startAPage();
                    var savePageIndex = 0;
                    function savePage(){
                        var url = allItem[savePageIndex];
                        console.log('item',url);
                        $.ajax({
                            url : "<?php echo admin_url('admin-ajax.php');?>",
                            data : {
                                url : url,
                                action : 'crawDataAjax'
                            },
                            type : "get",
                            dataType:"text",
                            success : function(result){
                                var html = $.parseHTML(result);
                                var data = {
                                    title : $(html).find(field_title).text(),
                                    url : document.location.href,
                                    image: $(html).find(field_image).attr('src'),
                                    content: $(html).find(field_content).html(),
                                    action : 'addPostData'
                                };
                                $.ajax({
                                    url : "<?php echo admin_url('admin-ajax.php');?>",
                                    data : data,
                                    type : "post",
                                    dataType:"text",
                                    success : function(result){
                                        var image = ( data.image ) ? '<img src="'+data.image+'"/>' : '';
                                        showMess('<span class="craw-item"><span>'+image+'</span><span>'+data.title+'</span></span>');
                                        var n = $( ".craw-item" ).length;
                                        $('.right .count').text(n);
                                        // Next post
                                        savePageIndex++;
                                        if (savePageIndex < allItem.length - 1){
                                            savePage();
                                        }
                                        else {
                                            currentPage++;
                                            startAPage();
                                        }
                                    }
                                });
                            }
                        });
                    }
                    return false;
                }); 
        });
    </script>
    <?php
    }
}
new ot_main_craw_data();