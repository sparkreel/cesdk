<?php
/**
 * User: Tabaré Caorsi <tabare@heapstersoft.com>
 * Date: 7/10/14
 * Time: 2:45 PM
 */

namespace CESdk\Models;


use CESdk\CESdk;

class Campaign
{
    /**
     * @var \CESdk\CESdk
     */
    private $sdk;

    protected $id;
    protected $clientName;
    protected $name;
    protected $sources = array();
    protected $keywords = array();
    /** @var \DateTime  */
    protected $startDate;
    /** @var \DateTime  */
    protected $endDate;
    /** @var \DateTime  */
    protected $maxAge;
    protected $status;
    protected $excludeInstagramComments = false;
    protected $videoCount = 0;
    protected $processedCount = 0;
    protected $deleted = false;

    const STATUS_RUNNING = 1;
    const STATUS_STOPPED = 0;


    /**
     * @param $name
     * @param $clientName
     * @param array $keywords
     * @param array $sources
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param \DateTime $maxAge
     * @param int $status
     * @param int $id
     * @param bool $excludeInstagramComments
     * @param int $videoCount
     * @param int $processedCount
     * @param bool $deleted
     * @param CESdk $sdk
     */
    function __construct($name, $clientName, array $keywords, array $sources, \DateTime  $startDate, \DateTime  $endDate, \DateTime  $maxAge, $status=0,
                         $id=null, $excludeInstagramComments = false, $videoCount = 0, $processedCount = 0, $deleted = false, CESdk $sdk = null)
    {
        $this->clientName = $clientName;
        $this->endDate = $endDate;
        $this->id = $id;
        $this->keywords = $keywords;
        $this->maxAge = $maxAge;
        $this->name = $name;
        $this->sdk = $sdk;
        $this->sources = $sources;
        $this->startDate = $startDate;
        $this->status = $status;
        $this->excludeInstagramComments = $excludeInstagramComments;
        $this->videoCount = $videoCount;
        $this->processedCount = $processedCount;
        $this->deleted = $deleted;
    }

    //Utility method
    public static function createFromArray(array $values, CESdk $sdk = null)
    {
        $campaign = new self(
            $values['name'],
            $values['client_name'],
            explode('|' ,$values['keywords']),
            explode('|' ,$values['sources']),
            new \DateTime($values['start_date']),
            new \DateTime($values['end_date']),
            new \DateTime($values['max_age']),
            $values['status'],
            $values['id'],
            $values['exclude_instagram_comments'],
            0,
            0,
            $values['deleted'],
            $sdk
        );

        return $campaign;
    }

    //Operations
    /**
     * @return Campaign
     */
    public function update()
    {
        $this->sdk->updateCampaign($this);

        return $this;
    }

    /**
     * @return Campaign
     */
    public function start()
    {
        $this->status = 1;
        $this->update();

        return $this;
    }

    /**
     * @return Campaign
     */
    public function stop()
    {
        $this->status = 0;
        $this->update();

        return $this;
    }


    //Getter and Setters
    /**
     * @param mixed $clientName
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     * @return mixed
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param boolean $excludeInstagramComments
     */
    public function setExcludeInstagramComments($excludeInstagramComments)
    {
        $this->excludeInstagramComments = $excludeInstagramComments;
    }

    /**
     * @return boolean
     */
    public function getExcludeInstagramComments()
    {
        return $this->excludeInstagramComments;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param \DateTime $maxAge
     */
    public function setMaxAge(\DateTime $maxAge)
    {
        $this->maxAge = $maxAge;
    }

    /**
     * @return \DateTime
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \CESdk\CESdk $sdk
     */
    public function setSdk($sdk)
    {
        $this->sdk = $sdk;
    }

    /**
     * @return \CESdk\CESdk
     */
    public function getSdk()
    {
        return $this->sdk;
    }

    /**
     * @param array $sources
     */
    public function setSources($sources)
    {
        $this->sources = $sources;
    }

    /**
     * @return array
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $processedCount
     */
    public function setProcessedCount($processedCount)
    {
        $this->processedCount = $processedCount;
    }

    /**
     * @return int
     */
    public function getProcessedCount()
    {
        return $this->processedCount;
    }

    /**
     * @param int $videoCount
     */
    public function setVideoCount($videoCount)
    {
        $this->videoCount = $videoCount;
    }

    /**
     * @return int
     */
    public function getVideoCount()
    {
        return $this->videoCount;
    }
} 