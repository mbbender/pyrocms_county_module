<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * County Module
 *
 * This is a sample module for PyroCMS
 * that add the County field type for use in your sites.
 *
 * Most of these functions use the Streams API CP driver which
 * is designed to handle repetitive CP tasks, down to even loading the page.
 *
 * @author 		Michael Bender
 * @package 	PyroCMS
 * @subpackage 	County Module
 */
class Admin extends Admin_Controller
{
    // This will set the active section tab
    protected $section = 'counties';

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('county');
        $this->load->driver('Streams');
    }

    /**
     * List all Counties using Streams CP Driver
     *
     * We are using the Streams API to grab
     * data from the counties database. It handles
     * pagination as well.
     *
     * @return	void
     */
    public function index()
    {
        // The extra array is where most of our
        // customization options go.
        $extra = array();

        // The title can be a string, or a language
        // string, prefixed by lang:
        $extra['title'] = 'lang:county:counties';
        
        // We can customize the buttons that appear
        // for each row. They point to our own functions
        // elsewhere in this controller. -entry_id- will
        // be replaced by the entry id of the row.
        $extra['buttons'] = array(
            array(
                'label' => lang('global:edit'),
                'url' => 'admin/county/edit/-entry_id-'
            ),
            array(
                'label' => lang('global:delete'),
                'url' => 'admin/county/delete/-entry_id-',
                'confirm' => true
            )
        );

        // In this example, we are setting the 5th parameter to true. This
        // signals the function to use the template library to build the page
        // so we don't have to. If we had that set to false, the function
        // would return a string with just the form.
        $this->streams->cp->entries_table('counties', 'county', 3, 'admin/county/index', true, $extra);
    }

    /**
     * List all Counties (Alternate)
     *
     * This example is similar to index(), but we are
     * getting entries manually using the entries API
     * and displaying the output in a custom view file.
     *
     * @return  void
     */
    public function index_alt()
    {
        // Get our entries. We are simply specifying
        // the stream/namespace, and then setting the pagination up.
        $params = array(
            'stream' => 'counties',
            'namespace' => 'county',
            'paginate' => 'yes',
            'limit' => 4,
            'pag_segment' => 4
        );
        $data['counties'] = $this->streams->entries->get_entries($params);

        // Build the page. See views/admin/index.php
        // for the view code.
        $this->template
                    ->title($this->module_details['name'])
                    ->build('admin/index', $data);
    }

    /**
     * Create a new County entry
     *
     * We're using the entry_form function
     * to generate the form.
     *
     * @return	void
     */
    public function create()
    {
        $extra = array(
            'return' => 'admin/county',
            'success_message' => lang('county:submit_success'),
            'failure_message' => lang('county:submit_failure'),
            'title' => 'lang:county:new',
         );

        $this->streams->cp->entry_form('counties', 'county', 'new', null, true, $extra);
    }
    
    /**
     * Edit a County entry
     *
     * We're using the entry_form function
     * to generate the edit form. We're passing the
     * id of the entry, which will allow entry_form to
     * repopulate the data from the database.
     *
     * @param   int [$id] The id of the FAQ to the be deleted.
     * @return	void
     */
    public function edit($id = 0)
    {
        $extra = array(
            'return' => 'admin/county',
            'success_message' => lang('county:submit_success'),
            'failure_message' => lang('county:submit_failure'),
            'title' => 'lang:county:edit'
        );

        $this->streams->cp->entry_form('counties', 'county', 'edit', $id, true, $extra);
    }

    /**
     * Delete a County entry
     * 
     * @param   int [$id] The id of County to be deleted
     * @return  void
     */
    public function delete($id = 0)
    {
        $this->streams->entries->delete_entry($id, 'counties', 'county');
        $this->session->set_flashdata('error', lang('county:deleted'));
 
        redirect('admin/county/');
    }

}