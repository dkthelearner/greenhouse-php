<?php 

namespace Krdinesh\Greenhouse\GreenhousePhp\Services;


use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;
use Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient;
use Krdinesh\Greenhouse\GreenhousePhp\Tools\BasicAuthorizationTrait;


class JobApiService extends Service {

    public function __construct($boardToken){
        $client = new GuzzleClient(['base_uri' => self::jobBoardBaseUrl($boardToken)]);
        $this->setClient($client);
        $this->boardToken = $boardToken;
    }
    /**
     * GET $baseUrl/offices
     *
     * @return string   JSON response string from Greenhouse API.
     * @throws GreenhouseAPIResponseException for non-200 responses
     */
    public function getOffices(){
        return $this->apiClient->get('offices');
    }
    
    /**
     * GET $baseUrl/office?id=$id
     *
     * @param   $id     number      The id of the office to retrieve
     * @return  string  JSON response string from Greenhouse API.
     * @throws  GreenhouseAPIResponseException for non-200 responses
     */
    public function getOffice($id){
        return $this->apiClient->get("office?id=$id");
    }
    
    /**
     * GET $baseUrl/departments
     *
     * @return string   JSON response string from Greenhouse API.
     * @throws GreenhouseAPIResponseException for non-200 responses
     */
    public function getDepartments(){
        return $this->apiClient->get('departments');
    }
    
    /**
     * GET $baseUrl/office?id=$id
     *
     * @param   $id     number      The id of the department to retrieve
     * @return  string  JSON response string from Greenhouse API.
     * @throws  GreenhouseAPIResponseException for non-200 responses
     */
    public function getDepartment($id){
        return $this->apiClient->get("department?id=$id");
    }
    
    /**
     * GET $baseUrl     (The Job board name and intro)
     *
     * @return  string  JSON response string from Greenhouse API.
     * @throws  GreenhouseAPIResponseException for non-200 responses
     */
    public function getBoard(){
        return $this->apiClient->get();
    }
    
    /**
     * GET $baseUrl/jobs(?content=true)
     *
     * @param   boolean     $content    Append the content paramenter to get the
     *                                      job post content, department, and office.
     * @return  string      JSON response string from Greenhouse API.
     * @throws  GreenhouseAPIResponseException for non-200 responses
     */
    public function getJobs($content=false){
        $queryString = $this->getContentQuery('jobs', $content);
        return $this->apiClient->get($queryString);
    }
    
    /**
     * GET $baseUrl/job?id=$id(?questions=true)
     *
     * @param   $id         number      The id of the job to retrieve
     * @param   $question   boolean     Append the question paramenter to get the
     *                                      question info in the job response.
     * @return  string      JSON response string from Greenhouse API.
     * @throws  GreenhouseAPIResponseException for non-200 responses
     */
    public function getJob($id, $questions=false)
    {
        $queryString = $this->getQuestionsQuery("job?id=$id", $questions);
        return $this->apiClient->get($queryString);
    }
    /**
     * Method appends the content parameter to the URL if content is true, returns
     * just the uriString if it's false.
     *
     * @param   string  $uriString      A base string.
     * @param   boolean $showConent     If true, appends ?content=true to $uriString
     * @return  string
     */
    public function getContentQuery($uriString, $showContent=false)
    {
        $queryString = $showContent ? '?content=true' : '';
        return $uriString . $queryString;
    }
    
    /**
     * Shortcut method appends questions=true to the query string for a single
     */
    public function getQuestionsQuery($uriString, $showQuestions=false)
    {
        $queryString = $showQuestions ? '&questions=true' : '';
        return $uriString . $queryString;
    }
}