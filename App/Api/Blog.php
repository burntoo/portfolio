<?php
namespace Portfolio\App\Api;

class Blog
{
    private $dashboard_api_key = DASHBOARD_API_KEY;
    private $dashboard_endpoint = DASHBOARD_ENDPOINT;
    private $curl;

    // API ENDPOINT
    public function __construct()
    {
        $this->curl = new \Portfolio\App\Api\Curl;
    }

    # List All Blogs
    public function getAllBlogs()
    {
        $insights =  json_decode($this->curl->get_file_contents($this->dashboard_endpoint . '/api/collections/get/insight?token=' . $this->dashboard_api_key), true);
        
        return $insights;
    }

    # List One Blog
    public function getOneBlog($slug)
    {
        $blog =  json_decode($this->curl->get_file_contents($this->dashboard_endpoint . '/api/collections/get/insight?token=' . $this->dashboard_api_key  . '&filter[title_slug]=' . $slug), true);
        
        return $blog;
    }
}