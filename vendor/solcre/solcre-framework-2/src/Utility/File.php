<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Solcre\SolcreFramework2\Utility;

use Exception;
use Zend\Filter\File\Rename;
use Zend\Filter\File\RenameUpload;

class File
{
    static $MIME_TYPES
        = array(
            "323"     => "text/h323",
            "acx"     => "application/internet-property-stream",
            "ai"      => "application/postscript",
            "aif"     => "audio/x-aiff",
            "aifc"    => "audio/x-aiff",
            "aiff"    => "audio/x-aiff",
            "asf"     => "video/x-ms-asf",
            "asr"     => "video/x-ms-asf",
            "asx"     => "video/x-ms-asf",
            "au"      => "audio/basic",
            "avi"     => "video/x-msvideo",
            "axs"     => "application/olescript",
            "bas"     => "text/plain",
            "bcpio"   => "application/x-bcpio",
            "bin"     => "application/octet-stream",
            "bmp"     => "image/bmp",
            "c"       => "text/plain",
            "cat"     => "application/vnd.ms-pkiseccat",
            "cdf"     => "application/x-cdf",
            "cer"     => "application/x-x509-ca-cert",
            "class"   => "application/octet-stream",
            "clp"     => "application/x-msclip",
            "cmx"     => "image/x-cmx",
            "cod"     => "image/cis-cod",
            "cpio"    => "application/x-cpio",
            "crd"     => "application/x-mscardfile",
            "crl"     => "application/pkix-crl",
            "crt"     => "application/x-x509-ca-cert",
            "csh"     => "application/x-csh",
            "css"     => "text/css",
            "dcr"     => "application/x-director",
            "der"     => "application/x-x509-ca-cert",
            "dir"     => "application/x-director",
            "dll"     => "application/x-msdownload",
            "dms"     => "application/octet-stream",
            "doc"     => "application/msword",
            "dot"     => "application/msword",
            "dvi"     => "application/x-dvi",
            "dxr"     => "application/x-director",
            "eps"     => "application/postscript",
            "etx"     => "text/x-setext",
            "evy"     => "application/envoy",
            "exe"     => "application/octet-stream",
            "fif"     => "application/fractals",
            "flr"     => "x-world/x-vrml",
            "gif"     => "image/gif",
            "gtar"    => "application/x-gtar",
            "gz"      => "application/x-gzip",
            "h"       => "text/plain",
            "hdf"     => "application/x-hdf",
            "hlp"     => "application/winhlp",
            "hqx"     => "application/mac-binhex40",
            "hta"     => "application/hta",
            "htc"     => "text/x-component",
            "htm"     => "text/html",
            "html"    => "text/html",
            "htt"     => "text/webviewhtml",
            "ico"     => "image/x-icon",
            "ief"     => "image/ief",
            "iii"     => "application/x-iphone",
            "ins"     => "application/x-internet-signup",
            "isp"     => "application/x-internet-signup",
            "jfif"    => "image/pipeg",
            "jpe"     => "image/jpeg",
            "jpeg"    => "image/jpeg",
            "jpg"     => "image/jpeg",
            "js"      => "application/x-javascript",
            "latex"   => "application/x-latex",
            "lha"     => "application/octet-stream",
            "lsf"     => "video/x-la-asf",
            "lsx"     => "video/x-la-asf",
            "lzh"     => "application/octet-stream",
            "m13"     => "application/x-msmediaview",
            "m14"     => "application/x-msmediaview",
            "m3u"     => "audio/x-mpegurl",
            "man"     => "application/x-troff-man",
            "mdb"     => "application/x-msaccess",
            "me"      => "application/x-troff-me",
            "mht"     => "message/rfc822",
            "mhtml"   => "message/rfc822",
            "mid"     => "audio/mid",
            "mny"     => "application/x-msmoney",
            "mov"     => "video/quicktime",
            "movie"   => "video/x-sgi-movie",
            "mp2"     => "video/mpeg",
            "mp3"     => "audio/mpeg",
            "mpa"     => "video/mpeg",
            "mpe"     => "video/mpeg",
            "mpeg"    => "video/mpeg",
            "mpg"     => "video/mpeg",
            "mpp"     => "application/vnd.ms-project",
            "mpv2"    => "video/mpeg",
            "ms"      => "application/x-troff-ms",
            "mvb"     => "application/x-msmediaview",
            "nws"     => "message/rfc822",
            "oda"     => "application/oda",
            "p10"     => "application/pkcs10",
            "p12"     => "application/x-pkcs12",
            "p7b"     => "application/x-pkcs7-certificates",
            "p7c"     => "application/x-pkcs7-mime",
            "p7m"     => "application/x-pkcs7-mime",
            "p7r"     => "application/x-pkcs7-certreqresp",
            "p7s"     => "application/x-pkcs7-signature",
            "pbm"     => "image/x-portable-bitmap",
            "pdf"     => "application/pdf",
            "pfx"     => "application/x-pkcs12",
            "pgm"     => "image/x-portable-graymap",
            "pko"     => "application/ynd.ms-pkipko",
            "pma"     => "application/x-perfmon",
            "pmc"     => "application/x-perfmon",
            "pml"     => "application/x-perfmon",
            "pmr"     => "application/x-perfmon",
            "pmw"     => "application/x-perfmon",
            "pnm"     => "image/x-portable-anymap",
            "pot"     => "application/vnd.ms-powerpoint",
            "ppm"     => "image/x-portable-pixmap",
            "pps"     => "application/vnd.ms-powerpoint",
            "ppt"     => "application/vnd.ms-powerpoint",
            "prf"     => "application/pics-rules",
            "ps"      => "application/postscript",
            "pub"     => "application/x-mspublisher",
            "qt"      => "video/quicktime",
            "ra"      => "audio/x-pn-realaudio",
            "ram"     => "audio/x-pn-realaudio",
            "ras"     => "image/x-cmu-raster",
            "rgb"     => "image/x-rgb",
            "rmi"     => "audio/mid",
            "roff"    => "application/x-troff",
            "rtf"     => "application/rtf",
            "rtx"     => "text/richtext",
            "scd"     => "application/x-msschedule",
            "sct"     => "text/scriptlet",
            "setpay"  => "application/set-payment-initiation",
            "setreg"  => "application/set-registration-initiation",
            "sh"      => "application/x-sh",
            "shar"    => "application/x-shar",
            "sit"     => "application/x-stuffit",
            "snd"     => "audio/basic",
            "spc"     => "application/x-pkcs7-certificates",
            "spl"     => "application/futuresplash",
            "src"     => "application/x-wais-source",
            "sst"     => "application/vnd.ms-pkicertstore",
            "stl"     => "application/vnd.ms-pkistl",
            "stm"     => "text/html",
            "svg"     => "image/svg+xml",
            "sv4cpio" => "application/x-sv4cpio",
            "sv4crc"  => "application/x-sv4crc",
            "t"       => "application/x-troff",
            "tar"     => "application/x-tar",
            "tcl"     => "application/x-tcl",
            "tex"     => "application/x-tex",
            "texi"    => "application/x-texinfo",
            "texinfo" => "application/x-texinfo",
            "tgz"     => "application/x-compressed",
            "tif"     => "image/tiff",
            "tiff"    => "image/tiff",
            "tr"      => "application/x-troff",
            "trm"     => "application/x-msterminal",
            "tsv"     => "text/tab-separated-values",
            "txt"     => "text/plain",
            "uls"     => "text/iuls",
            "ustar"   => "application/x-ustar",
            "vcf"     => "text/x-vcard",
            "vrml"    => "x-world/x-vrml",
            "wav"     => "audio/x-wav",
            "wcm"     => "application/vnd.ms-works",
            "wdb"     => "application/vnd.ms-works",
            "wks"     => "application/vnd.ms-works",
            "wmf"     => "application/x-msmetafile",
            "wps"     => "application/vnd.ms-works",
            "wri"     => "application/x-mswrite",
            "wrl"     => "x-world/x-vrml",
            "wrz"     => "x-world/x-vrml",
            "xaf"     => "x-world/x-vrml",
            "xbm"     => "image/x-xbitmap",
            "xla"     => "application/vnd.ms-excel",
            "xlc"     => "application/vnd.ms-excel",
            "xlm"     => "application/vnd.ms-excel",
            "xls"     => "application/vnd.ms-excel",
            "xlt"     => "application/vnd.ms-excel",
            "xlw"     => "application/vnd.ms-excel",
            "xof"     => "x-world/x-vrml",
            "xpm"     => "image/x-xpixmap",
            "xwd"     => "image/x-xwindowdump",
            "z"       => "application/x-compress",
            "zip"     => "application/zip"
        );

    public static function uploadFile($data, $options = array())
    {
        $targetDir = empty($options['target_dir']) ? './data/uploads/' : $options['target_dir'];
        $key = empty($options['key']) ? 'file' : $options['key'];
        $target = $targetDir . $data[$key]['name'];

        if (!empty($options['prefix'])) {
            $fileExtension = self::fileExtension($data[$key]['name']);
            $target = $targetDir . $options['prefix'] . '.' . $fileExtension;
        }

        if ($options['is_uploaded']) {

            $filter = new Rename(array(
                "source"    => $data[$key]['tmp_name'],
                "target"    => $target,
                "randomize" => $options['hash'],
            ));
        } else {

            $filter = new RenameUpload(array(
                "target"    => $target,
                "randomize" => $options['hash'],
            ));

        }
        $file = $filter->filter($data[$key]);
        chmod($file["tmp_name"], 0644);
        return $file;
    }

    public static function checkAndUploadFile($data, $options = array())
    {
        $key = empty($options['key']) ? 'file' : $options['key'];
        $keyText = empty($options['key_text']) ? 'filename' : $options['key_text'];
        $fileName = "";
        if (!empty($data[$key])) {
            //Upload file and set $fileName
            $file = self::uploadFile($data, $options);
            $fileName = self::fileNameExtract($file['tmp_name']);
        } else {
            if (!empty($data[$keyText])) {
                //Return key text value
                $fileName = $data[$keyText];
            }
        }
        return $fileName;
    }

    public static function fileExtension($fileName)
    {
        $fileNameParts = explode('.', $fileName);
        return array_pop($fileNameParts);
    }

    public static function fileNameExtract($fullFileName)
    {
        $fileName = explode('/', $fullFileName);
        return array_pop($fileName);
    }

    public static function deleteFile($path)
    {
        if (!unlink($path)) {
            throw new Exception("An error occurred deleting the file", 400);
        }
    }

    public static function fileExists($path)
    {
        return file_exists($path);
    }

    public static function format_bytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public static function getFileName($name, $path)
    {
        $name = self::nameWithoutCommas($name);
        $name = self::nameWithoutSpaces($name);
        $name = self::uniqueNameFolder($name, $path);
        return $name;
    }

    public static function nameWithoutSpaces($name)
    {
        return str_replace(" ", "_", $name);
    }

    public static function nameWithoutCommas($name)
    {
        return str_replace("'", "", stripslashes($name));
    }

    public static function uniqueNameFolder($nameFull, $file)
    {
        $info = explode('.', $nameFull);
        $name = $info[0];
        $extension = $info[1];
        if (!empty($name)) {
            $resource = $file . $nameFull;
            $i = 0;
            while (is_file($resource)) {
                $i++;
                $resource = $file . $name . $i;
                $name = $name . $i;
            }
        }
        return $name . "." . $extension;
    }

    public static function renameFile($oldPath, $newPath)
    {
        if (!is_dir($newPath)) {
            return rename($oldPath, $newPath);
        } else {
            return false;
        }
    }

    public static function write($path, $content, $perm = 0644)
    {
        $dir = dirname($path);
        $tmp = tempnam($dir, "columnis");
        if (file_put_contents($tmp, $content) === false) {
            throw new \RuntimeException('Failed to write temporary file (' . $tmp . ').');
        }

        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);

        if (is_file($path)) {
            if (!unlink($path)) {
                throw new \RuntimeException('Failed to remove old file.');
            }
        }

        if (!rename($tmp, $path)) {
            throw new \RuntimeException('Failed to move temporary file.');
        }

        if (is_int($perm)) {
            if (!chmod($path, $perm)) {
                throw new \RuntimeException('Failed to apply permisions to file.');
            }
        }

        return true;
    }

    public static function mime_content_type($filename)
    {
        $ext = strtolower(array_pop(explode('.', $filename)));
        if (array_key_exists($ext, self::$MIME_TYPES)) {
            return self::$MIME_TYPES[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } elseif (function_exists('mime_content_type')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } // @TODO: Elseif verificar si es una foto usar getimagesize
        else {
            return 'application/octet-stream';
        }
    }

    public static function extension($file)
    {
        $ext = explode(".", $file);
        $count = count($ext);
        return $count > 1 ? $ext[$count - 1] : null;
    }

}
