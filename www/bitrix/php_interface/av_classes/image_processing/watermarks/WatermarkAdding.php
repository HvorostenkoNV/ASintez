<?
namespace Av\ImageProcessing\Watermarks;

use
	Exception,
	SplFileInfo;
/** ***********************************************************************************************
 * Adding watermark to image class
 *
 * @property SplFileInfo $imageObject                   image object
 * @property SplFileInfo $watermarkObject               watermark image object
 * @property SplFileInfo $imageProcessedFolderObject    image processed folder object
 *
 * @package av_image_processing
 * @author  Hvorostenko
 *************************************************************************************************/
final class WatermarkAdding
{
	private
		$imageObject                = NULL,
		$watermarkObject            = NULL,
		$imageProcessedFolderObject = NULL,

		$watermarkOpacity   = 0.5,
		$watermarkSpaceX    = 0,
		$watermarkSpaceY    = 0;
	private static
		$watermarkImageDefault          = '/bitrix/images/av/images_watermark/water_mark.png',
		$imagesProcessedFolderDefault   = '/upload/images_watermark/',
		$cryptKey                       = '1591789hGguB177lLL';
	/** **********************************************************************
	 * constructor
	 * @param   string  $imagePath      image path
	 * @throws  Exception               image path incorrect
	 ************************************************************************/
	public function __construct($imagePath = '')
	{
		try
		{
			$this->setImage($imagePath);
		}
		catch( Exception $exception )
		{
			throw new Exception($exception->getMessage());
		}
	}
	/** **********************************************************************
	 * set image path
	 * @param   string  $imagePath      image path
	 * @throws  Exception               image path incorrect
	 ************************************************************************/
	public function setImage($imagePath = '')
	{
		$image = new SplFileInfo
		(
			$_SERVER['DOCUMENT_ROOT'].
			str_replace($_SERVER['DOCUMENT_ROOT'], '', $imagePath)
		);

		if( !is_string($imagePath) )
			throw new Exception('geted image path is not a string');
		if( !$image->isFile() )
			throw new Exception('geted image is not a file by path "'.$imagePath.'"');
		if( !$image->isReadable() )
			throw new Exception('geted image is not readable');

		$this->imageObject = $image;
	}
	/** **********************************************************************
	 * get image path
	 * @return  string                  image path
	 ************************************************************************/
	public function getImage()
	{
		return $this->imageObject
			? str_replace($_SERVER['DOCUMENT_ROOT'], '', $this->imageObject->getPathname())
			: '';
	}
	/** **********************************************************************
	 * set watermark image path
	 * @param   string  $imagePath      watermark image path
	 * @throws  Exception               watermark image path incorrect
	 ************************************************************************/
	public function setWatermarkImage($imagePath = '')
	{
		$image = new SplFileInfo
		(
			$_SERVER['DOCUMENT_ROOT'].
			str_replace($_SERVER['DOCUMENT_ROOT'], '', $imagePath)
		);

		if( !is_string($imagePath) )
			throw new Exception('geted watermark image path is not a string');
		if( !$image->isFile() )
			throw new Exception('geted watermark image is not a file by path "'.$imagePath.'"');
		if( !$image->isReadable() )
			throw new Exception('geted watermark image is not readable');

		$this->watermarkObject = $image;
	}
	/** **********************************************************************
	 * get watermark image path
	 * @return  string                  watermark image path
	 ************************************************************************/
	public function getWatermarkImage()
	{
		return $this->watermarkObject
			? str_replace($_SERVER['DOCUMENT_ROOT'], '', $this->watermarkObject->getPathname())
			: '';
	}
	/** **********************************************************************
	 * set images processed folder
	 * @param   string  $folderPath     image processed folder path
	 * @throws  Exception               image processed folder path incorrect
	 ************************************************************************/
	public function setImagesProcessedFolder($folderPath = '')
	{
		$folder = new SplFileInfo
		(
			$_SERVER['DOCUMENT_ROOT'].
			str_replace($_SERVER['DOCUMENT_ROOT'], '', $folderPath)
		);

		if( !is_string($folderPath) )
			throw new Exception('geted image processed folder path is not a string');

		if( !$folder->isDir() )
			mkdir($folder->getPathname(), 0777, true);
		if( !$folder->isDir() )
			throw new Exception('can not create directory by path "'.$folder->getPathname().'"');

		$this->imageProcessedFolderObject = $folder;
	}
	/** **********************************************************************
	 * get images processed folder
	 * @return  string                  image processed folder path
	 ************************************************************************/
	public function getImagesProcessedFolder()
	{
		return $this->imageProcessedFolderObject
			? str_replace($_SERVER['DOCUMENT_ROOT'], '', $this->imageProcessedFolderObject->getPathname())
			: '';
	}
	/** **********************************************************************
	 * set watermark opacity
	 * @param   float   $opacity        watermark opacity
	 ************************************************************************/
	public function setWatermarkOpacity($opacity = 0.0)
	{
		$this->watermarkOpacity = (float) $opacity;
	}
	/** **********************************************************************
	 * get watermark opacity
	 * @return   float                  watermark opacity
	 ************************************************************************/
	public function getWatermarkOpacity()
	{
		return $this->watermarkOpacity;
	}
	/** **********************************************************************
	 * set watermark between space horizontal
	 * @param   int     $space          watermark between space horizontal
	 ************************************************************************/
	public function setWatermarkSpaceX($space = 0)
	{
		$this->watermarkSpaceX = (int) $space;
	}
	/** **********************************************************************
	 * get watermark between space horizontal
	 * @return  int                     watermark between space horizontal
	 ************************************************************************/
	public function getWatermarkSpaceX()
	{
		return $this->watermarkSpaceX;
	}
	/** **********************************************************************
	 * set watermark between space vertical
	 * @param   int     $space          watermark between space vertical
	 ************************************************************************/
	public function setWatermarkSpaceY($space = 0)
	{
		$this->watermarkSpaceY = (int) $space;
	}
	/** **********************************************************************
	 * get watermark between space vertical
	 * @return  int                     watermark between space vertical
	 ************************************************************************/
	public function getWatermarkSpaceY()
	{
		return $this->watermarkSpaceY;
	}
	/** **********************************************************************
	 * get image url with added watermarks
	 * @return  string                  image url
	 * @throws  Exception               process error
	 ************************************************************************/
	public function getImageProcessedUrl()
	{
		/** *********************************************
		 ************ check watermark ready *************
		 ***********************************************/
		if( !$this->watermarkObject )
		{
			try
			{
				$this->setWatermarkImage(self::$watermarkImageDefault);
			}
			catch( Exception $exception )
			{
				throw new Exception($exception->getMessage());
			}
		}
		/** *********************************************
		 ************** check image ready ***************
		 ***********************************************/
		if( !$this->imageObject )
			throw new Exception('No image seted');
		/** *********************************************
		 ***** check images processed folder ready ******
		 ***********************************************/
		if( !$this->imageProcessedFolderObject )
		{
			try
			{
				$this->setImagesProcessedFolder(self::$imagesProcessedFolderDefault);
			}
			catch( Exception $exception )
			{
				throw new Exception($exception->getMessage());
			}
		}
		/** *********************************************
		 ***** check processed image already exist ******
		 ***********************************************/
		$processedImage = new SplFileInfo
		(
			$this->imageProcessedFolderObject->getPathname().DIRECTORY_SEPARATOR.
			$this->buildEncryptedString
			([
				$this->imageObject->getPathname(),
				$this->watermarkOpacity,
				$this->watermarkSpaceX,
				$this->watermarkSpaceY
			]).
			'.png'
		);
		if( $processedImage->isFile() )
			return str_replace($_SERVER['DOCUMENT_ROOT'], '', $processedImage->getPathname());
		/** *********************************************
		 ***************** need params ******************
		 ***********************************************/
		$watermarkResource  = $this->getImageResource($this->watermarkObject, $this->watermarkOpacity);
		$watermarkWidth     = (int) imagesx($watermarkResource);
		$watermarkHeight    = (int) imagesy($watermarkResource);

		$imageResource      = $this->getImageResource($this->imageObject);
		$imageWidth         = (int) imagesx($imageResource);
		$imageHeight        = (int) imagesy($imageResource);

		$watermarkSpaceX    = $this->watermarkSpaceX > 0 ? $this->watermarkSpaceX : $watermarkWidth  / 3;
		$watermarkSpaceY    = $this->watermarkSpaceY > 0 ? $this->watermarkSpaceY : $watermarkHeight * 3;
		$currentRow         = 1;
		$rowCount           = floor($imageHeight / ($watermarkHeight + $watermarkSpaceY));
		$watermarkSpaceY    = ($imageHeight - $watermarkHeight * $rowCount) / $rowCount;
		$watermarkPositionX = 0 - $watermarkWidth / 2;
		$watermarkPositionY = $watermarkSpaceY / 2;
		/** *********************************************
		 ************* watermark processing *************
		 ***********************************************/
		while( $currentRow <= $rowCount )
		{
			imagecopy
			(
				$imageResource,
				$watermarkResource,
				$watermarkPositionX,
				$watermarkPositionY,
				0,
				0,
				$watermarkWidth,
				$watermarkHeight
			);

			$watermarkPositionX += $watermarkWidth + $watermarkSpaceX;
			if( $watermarkPositionX > $imageWidth )
			{
				$currentRow++;
				$watermarkPositionX = 0 - $watermarkWidth / 2 + $watermarkSpaceX * $currentRow * 2;
				while( $watermarkPositionX > $watermarkSpaceX )
					$watermarkPositionX -= $watermarkWidth;
				$watermarkPositionY += $watermarkHeight + $watermarkSpaceY;
			}
		}
		/** *********************************************
		 ************* save file/return link ************
		 ***********************************************/
		imagepng($imageResource, $processedImage->getPathname(), 9);

		if( !$processedImage->isFile() )
			throw new Exception('Image with watermarks creating failed');

		return str_replace($_SERVER['DOCUMENT_ROOT'], '', $processedImage->getPathname());
	}
	/** **********************************************************************
	 * build unique encrypted string based on array of params
	 * @param   array   $params         array of params
	 * @return  string                  unique encrypted string
	 ************************************************************************/
	private function buildEncryptedString($params = [])
	{
		if( !is_array($params) )
			return '';

		$encryptedString = openssl_encrypt
		(
			implode('', array_values($params)),
			'AES-256-OFB',
			self::$cryptKey
		);

		return base64_encode($encryptedString);
	}
	/** **********************************************************************
	 * get image resource
	 * @param   SplFileInfo $image      image object
	 * @param   float       $opacity    image opacity
	 * @return  resource|NULL           image resource
	 ************************************************************************/
	private function getImageResource(SplFileInfo $image, $opacity = 0.0)
	{
		$opacity = (float) $opacity;

		switch( $image->getExtension() )
		{
			case 'png':
				$resource = imagecreatefrompng($image->getPathname());

				if( $opacity > 0 )
				{
					imagealphablending($resource, false);
					imagesavealpha($resource, true);
					imagefilter($resource, IMG_FILTER_COLORIZE, 100, 100, 100, 127 * $opacity);
				}
				else
				{
					imagealphablending($resource, true);
					imagesavealpha($resource, true);
				}

				return $resource;
			case 'jpg':
			case 'jpeg':
				return imagecreatefromjpeg($image->getPathname());
			default:
				return NULL;
		}
	}
}