<?php
/**
 * User: Tabaré Caorsi <tabare@heapstersoft.com>
 * Date: 7/17/14
 * Time: 3:22 PM
 */

namespace CESdk\Models;


use CESdk\Models\Campaign;

class Content
{
    private $id = 0;
    private $source = '';
    /** @var Campaign  */
    private $campaign = null;
    /** @var \DateTime */
    private $foundAt = null;
    private $nativeId = '';
    /** @var \DateTime */
    private $createdAt = null;
    private $url = '';
    private $thumb = '';
    private $videoSrc = '';
    private $description = '';
    private $title = '';
    private $videoLength = 0;
    private $username = '';
    private $viewCount = 0;
    private $likeCount = 0;
    private $dislikeCount = 0;
    private $favCount = 0;
    private $commentCount = 0;
    private $twCount = 0;
    private $fbCount = 0;
    private $processed = 0;
    /** @var \DateTime */
    private $processedAt = null;
    private $keyword = '';
    private $userNativeId = '';
    private $popularity = null;

    public function __construct($id, Campaign $campaign = null)
    {
        $this->id = $id;
        $this->campaign = $campaign;
    }

    /**
     * @param Campaign $campaign
     * @param array $array
     * @return Campaign|Content
     */
    public static function createFromArray(Campaign $campaign=null, array $array=array())
    {
        $defaults = array(
            "view_count"=>0,
            "like_count"=>0,
            "dislike_count"=>0,
            "favorite_count"=>0,
            "comment_count"=>0,
            "tw_share_count"=>0,
            "fb_share_count"=>0,
        );

        $array = array_merge($defaults, $array);

        $content = new self($array['id'], $campaign);
        $content->setSource($array['source']);
        $content->setFoundAt(new \DateTime($array['found_at']));
        $content->setNativeId($array['native_id']);
        $content->setCreatedAt(new \DateTime($array['created_at']));
        $content->setUrl($array['url']);
        $content->setThumb($array['thumb']);
        $content->setVideoSrc($array['video_src']);
        $content->setTitle($array['title']);
        $content->setDescription($array['description']);
        $content->setVideoLength($array['video_length']);
        $content->setUsername($array['username']);
        $content->setViewCount($array['view_count']);
        $content->setLikeCount($array['like_count']);
        $content->setDislikeCount($array['dislike_count']);
        $content->setFavCount($array['favorite_count']);
        $content->setCommentCount($array['comment_count']);
        $content->setTwCount($array['tw_share_count']);
        $content->setFbCount($array['fb_share_count']);
        $content->setProcessed($array['processed']);
        if ($array['processed']) {
            $content->setProcessedAt(new \DateTime($array['processed_at']));
        }
        $content->setKeyword($array['keyword']);
        $content->setUserNativeId($array['user_native_id']);

        if (isset($array['popularity'])) {
            $content->popularity = $array['popularity'];
        }

        return $content;
    }

    /**
     * @param Campaign $campaign
     */
    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @param int $commentCount
     */
    public function setCommentCount($commentCount)
    {
        $this->commentCount = $commentCount;
    }

    /**
     * @return int
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $dislikeCount
     */
    public function setDislikeCount($dislikeCount)
    {
        $this->dislikeCount = $dislikeCount;
    }

    /**
     * @return int
     */
    public function getDislikeCount()
    {
        return $this->dislikeCount;
    }

    /**
     * @param int $favCount
     */
    public function setFavCount($favCount)
    {
        $this->favCount = $favCount;
    }

    /**
     * @return int
     */
    public function getFavCount()
    {
        return $this->favCount;
    }

    /**
     * @param int $fbCount
     */
    public function setFbCount($fbCount)
    {
        $this->fbCount = $fbCount;
    }

    /**
     * @return int
     */
    public function getFbCount()
    {
        return $this->fbCount;
    }

    /**
     * @param \DateTime $foundAt
     */
    public function setFoundAt(\DateTime $foundAt)
    {
        $this->foundAt = $foundAt;
    }

    /**
     * @return \DateTime
     */
    public function getFoundAt()
    {
        return $this->foundAt;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param int $likeCount
     */
    public function setLikeCount($likeCount)
    {
        $this->likeCount = $likeCount;
    }

    /**
     * @return int
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @param string $nativeId
     */
    public function setNativeId($nativeId)
    {
        $this->nativeId = $nativeId;
    }

    /**
     * @return string
     */
    public function getNativeId()
    {
        return $this->nativeId;
    }

    /**
     * @param int $processed
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;
    }

    /**
     * @return int
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * @param \DateTime $processedAt
     */
    public function setProcessedAt(\DateTime $processedAt)
    {
        $this->processedAt = $processedAt;
    }

    /**
     * @return \DateTime
     */
    public function getProcessedAt()
    {
        return $this->processedAt;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $thumb
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param int $twCount
     */
    public function setTwCount($twCount)
    {
        $this->twCount = $twCount;
    }

    /**
     * @return int
     */
    public function getTwCount()
    {
        return $this->twCount;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $userNativeId
     */
    public function setUserNativeId($userNativeId)
    {
        $this->userNativeId = $userNativeId;
    }

    /**
     * @return string
     */
    public function getUserNativeId()
    {
        return $this->userNativeId;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param int $videoLenth
     */
    public function setVideoLength($videoLenth)
    {
        $this->videoLength = $videoLenth;
    }

    /**
     * @return int
     */
    public function getVideoLength()
    {
        return $this->videoLength;
    }

    /**
     * @param string $videoSrc
     */
    public function setVideoSrc($videoSrc)
    {
        $this->videoSrc = $videoSrc;
    }

    /**
     * @return string
     */
    public function getVideoSrc()
    {
        return $this->videoSrc;
    }

    /**
     * @param int $viewCount
     */
    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;
    }

    /**
     * @return int
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @param null $popularity
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;
    }

    /**
     * @return null
     */
    public function getPopularity()
    {
        return $this->popularity;
    }



} 