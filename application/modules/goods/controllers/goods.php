<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goods extends MY_Controller {

    /**
     * Example page
     */
    public function index()
    {
        $this->load->library('template');

        // Use custom layout (application/views/layout/pagelet.php)
        $this->template->set_layout('pagelet');
        $this->template->set_title('Список товаров');

        $this->template->load_view('goods/index', array(
            // Load todo pagelet with some fake items
            'pagelet_goods' => Modules::run('goods/_pagelet_goods', array(
                array(
                    'title' => 'Read the CI documentation',
                    'completed' => TRUE,
                ),
                array(
                    'title' => 'Learn how to use Modular Extensions - HMVC',
                    'completed' => FALSE,
                ),
            )),
        ));
    }

    /**
     * Render all todo items
     * and an ajax form to submit new item
     */
    public function _pagelet_goods($items = array())
    {
        $this->load->helper('form');

        $items_left = 0;
        foreach ($items as $item)
        {
            if ( ! $item['completed'])
            {
                $items_left++;
            }
        }
        $this->load->view('goods/pagelet_goods', array(
            'items' => $items,
            'items_left' => $items_left,

            // Show upload control from jQuery file upload add-on
            // if it was already installed
            'pagelet_upload_control' => Modules::run('photo/_pagelet_upload_control', array(
                // Only display upload button and the uploaded photo
                'message' => '',
                'is_multiple' => FALSE,
                'progress_template' => FALSE,
                'item_template' => '
                    <input type="hidden" name="thumbnail" value="{{thumbnailUrl}}">
                    <img src="{{thumbnailUrl}}" style="width: 50px; height: 50px; padding: 1px;">
                ',
            )),
        ));
    }

    /**
     * Render todo item
     */
    public function _pagelet_item($item)
    {
        $this->load->view('goods/pagelet_item', $item);
    }
}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */