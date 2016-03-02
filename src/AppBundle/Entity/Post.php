<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Post
 *
 *  @ORM\Entity
 * @ORM\Table(name="users")
 */
class Post
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @var integer
     */
    private $title;

    /**
     * @var integer
     */
    private $description;
    /**
     * @var integer
     */
    private $Price;

    /**
     * @var integer
     */
    private $initDDate;

    /**
     * @var integer
     */
    private $expiryDate;

    /**
     * @var integer
     */
    private $status;

    /**
     * @return int
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param int $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @param int $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @return int
     */
    public function getInitDDate()
    {
        return $this->initDDate;
    }

    /**
     * @param int $initDDate
     */
    public function setInitDDate($initDDate)
    {
        $this->initDDate = $initDDate;
    }

    /**
     * @return int
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * @param int $expiryDate
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $Status
     */
    public function setStatus($Status)
    {
        $this->status = $Status;
    }

    /**
     * @var string
     */
    private $file;

    /**
     * Set file
     *
     * @param string $file
     * @return Post
     */
    public function setFile(UploadedFile $file = null)
    {

        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir() . '/' . $this->path;
    }

    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/file in the view.
        return 'uploads/blogFiles';
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }
        $dirpath = $this->getUploadRootDir();
        $file = $this->getFile()->getClientOriginalName();
        $ext = $this->getFile()->guessExtension();
        $name = substr($file, 0, - strlen($ext));
        $i = 1;
        while(file_exists($dirpath . '/' .  $file)) {
            $file = $name . '-' . $i .'.'. $ext;
            $i++;
        }
        $this->getFile()->move($dirpath,$file);
        $this->file = $file;
        $this->path = $this->getUploadDir();
        $this->file = null;
    }
}