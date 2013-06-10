<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_County extends Module
{
    public $version = '1.0';

    public function info()
    {
        return array(
            'name' => array(
                'en' => 'County'
            ),
            'description' => array(
                'en' => 'US Counties'
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'data',
            'shortcuts' => array(
                array(
                    'name' => 'county:new',
                    'uri' => 'admin/county/create',
                    'class' => 'add',
                ),
            ),

        );
    }

    /**
     * Install
     *
     * This function will set up our
     * Counties streams.
     */
    public function install()
    {
        // We're using the streams API to
        // do data setup.
        $this->load->driver('Streams');

        $this->load->language('county/county');

        // Add County streams
        if ( ! $this->streams->streams->add_stream('lang:county:counties', 'counties', 'county', 'county_', null)) return false;

        // Add some fields
        $fields = array(
            array(
                'name' => 'County',
                'slug' => 'county',
                'namespace' => 'county',
                'type' => 'text',
                'extra' => array('max_length' => 255),
                'assign' => 'counties',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'State',
                'slug' => 'state',
                'namespace' => 'county',
                'type' => 'state',
                'assign' => 'counties',
                'required' => true
            )
        );

        $this->streams->fields->add_fields($fields);

        $this->streams->streams->update_stream('counties', 'county', array(
            'view_options' => array(
                'id',
                'county',
                'state'
            )
        ));


        return true;
    }

    /**
     * Uninstall
     *
     * Uninstall our module - this should tear down
     * all information associated with it.
     */
    public function uninstall()
    {
        $this->load->driver('Streams');

        // For this teardown we are using the simple remove_namespace
        // utility in the Streams API Utilties driver.
        $this->streams->utilities->remove_namespace('county');

        return true;
    }

    public function upgrade($old_version)
    {
        return true;
    }

    public function help()
    {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}