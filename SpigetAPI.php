<?php

/*
    Copyright (c) 2018 Jens F.

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 */

/**
 * Created by Th3Shadowbroker/M4taiori https://m4taiori.de
 * GitHub: https://github.com/th3shadowbroker
 * Date: 30.06.2018
 * Time: 14:19
 */

namespace de\m4taiori\spiget4php;

require 'Exceptions/SpigetException.php';

use de\m4taiori\spiget4php\exceptions\SpigetException as SpigetException;

/**
 * This is the main-class of spiget4php.
 * Use the getInstance function to create a new instance or get an existing instance.
 *
 * @see \de\m4taiori\spiget4php\exceptions\SpigetException SpigetException - This exception will be thrown if something goes wrong and $throwExceptions is true.
 *
 * @package de\m4taiori\spiget4php
 */
class SpigetAPI
{

    /**
     * @var SpigetAPI The current instance of this class.
     */
    private static $instance;

    /**
     * @var string The useragent-name defined by the api-user.
     */
    private $userargent;

    /**
     * @var string The url of the spiget-api.
     */
    private $spiget = 'https://api.spiget.org/v2/';

    /**
     * @var bool Used to toggle exception throwing.
     */
    private $throwExceptions = true;

    /**
     * SpigetAPI constructor.
     * @param $useragent string The useragent-name you want to use.
     */
    private function __construct( $useragent )
    {
        $this->userargent = $useragent;
    }

    /**
     * Get a authors detailed record.
     * @param $author string The name or id of the author.
     * @return array
     * @throws SpigetException
     */
    public function getAuthor( $author )
    {
        return $this->getResult( "authors/".$author );
    }

    /**
     * Get a list of authors.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getAuthorList( $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'authors';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get the reviews of an specific author.
     * @param string $author The authors name or id.
     * @param int $size The results max. size.
     * @param int $page The page you want to get.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getAuthorReviews( $author, $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'authors/'.$author.'/reviews';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get the resources of an specific author.
     * @param string $author The authors name or id.
     * @param int $size The results max. size.
     * @param int $page The page you want to get.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getAuthorResources( $author, $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'authors/'.$author.'/resources';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a list of categories.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getCategoryList( $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'categories';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get detailed information about an specific category.
     * @param string $category The name or id of the category.
     * @return array
     * @throws SpigetException
     */
    public function getCategory( $category )
    {
        $function = 'categories/'.$category;
        return $this->getResult( $function );
    }

    /**
     * Get a list of resources of an specific category.
     * @param string The category you want to search in.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getCategoryResources( $category, $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'categories/'.$category.'/resources';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get detailed information about an specific resource.
     * @param $resource string The resource.
     * @return array
     * @throws SpigetException
     */
    public function getResource( $resource )
    {
        $function = 'resources/'.$resource;
        return $this->getResult( $function );
    }

    /**
     * Get detailed information about the author of an specific resource.
     * @param $resource string The resource.
     * @return array
     * @throws SpigetException
     */
    public function getResourceAuthor( $resource )
    {
        $function = 'resources/'.$resource.'/author';
        return $this->getResult( $function );
    }

    /**
     * Get a list of resource-reviews of an specific resource.
     * @param string $resource The resource you want to read the reviews of.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getResourceReviews( $resource, $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'resources/'.$resource.'/reviews';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a list of updates for an specific resource.
     * @param string $resource The resource you want get the list for.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getResourceUpdates( $resource, $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'resources/'.$resource.'/updates';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a resources versions.
     * @param string $resource The resource you want get the versions of.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getResourceVersionList( $resource, $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'resources/'.$resource.'/versions';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a resource-search results..
     * @param string $resource The resource-name you're looking for..
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getSearchResource( $resource, $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'search/resources/'.$resource;
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a list of resources.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getResourceList( $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'resources';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a list of free resources.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getFreeResourceList( $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'resources/free';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a list of premium resources.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getPremiumResourceList( $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'resources/premium';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a list of the newest resources.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getNewResourceList( $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'resources/new';
        $args = [];
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get a list of resources for an specific version of minecraft/spigot.
     * @param string The version.
     * @param string The search-method. Use any or all.
     * @param int $size The size of the list.
     * @param int $page The page of the list.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getResourcesForVersion( $version, $method = 'any',$size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'resources/for/'.$version;
        $args = [];
        if ( !is_null( $method ) ) $args['method'] = $method;
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get the search-result for an specific username.
     * @param string $author The authors name or id.
     * @param string $field The field you want to search in.
     * @param int $size The results max. size.
     * @param int $page The page you want to get.
     * @param string $sort Sort the list with + for ascending and - for descending in front of the field you want to sort by.
     * @param array $fields The fields you want to receive.
     * @return array
     * @throws SpigetException
     */
    public function getSearchAuthors( $author, $field = null, $size = null, $page =  null, $sort = null, $fields = null )
    {
        $function = 'search/authors/'.$author;
        $args = [];
        if ( !is_null( $field ) ) $args['field'] = $field;
        if ( !is_null( $size ) ) $args['size'] = $size;
        if ( !is_null( $page ) ) $args['page'] = $page;
        if ( !is_null( $sort ) ) $args['sort'] = $sort;
        if ( !is_null( $fields ) ) $args['fields'] = implode(',', $fields );
        return $this->getResult( $function, $args );
    }

    /**
     * Get the api-status.
     * @return array
     * @throws SpigetException
     */
    public function getAPIStatus()
    {
        $function = 'status';
        return $this->getResult($function);
    }

    /**
     * Get the result of an api-request.
     * @param $function string The rest-function you want to access.
     * @param $args array Assoc containing the arguments transmitted within the url.
     * @param $post bool Use post instead of get.
     * @return array
     * @throws SpigetException
     */
    private function getResult($function, $args = [], $post = false )
    {
        $qargs = ($post ? '' : '?') . http_build_query( $args );

        $curl = curl_init( $this->spiget.$function.( !$post ? ( sizeof( $args ) > 0 ? $qargs : '' ) : '' ) );

        curl_setopt($curl, CURLOPT_USERAGENT, $this->userargent);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if ($post) curl_setopt($curl,CURLOPT_POST, 1);
        if ($post) curl_setopt($curl, CURLOPT_POSTFIELDS, $qargs);

        $result = curl_exec($curl);
        $http_response = curl_getinfo($curl)['http_code'];

        curl_close($curl);

        if ( $http_response == 200 )
        {
            return json_decode( $result, true );
        }
        elseif ( $this->throwExceptions )
        {
            throw new SpigetException( json_decode( $result, true )['error'], $http_response );
        }
        else
        {
            return null;
        }
    }

    /**
     * Set the throw-exceptions option.
     * @param $enabled bool Enabled or disabled.
     */
    public function setThrowExceptions( $enabled )
    {
        $this->throwExceptions = $enabled;
    }

    /**
     * To enable or disable exception throwing use the setThrowExceptions function.
     * @return bool True if throwing exceptions is enabled.
     */
    public function isThrowingExceptions()
    {
        return $this->throwExceptions;
    }

    /**
     * Get the current instance of the api-wrapper or create a new one.
     * @param string $useragent The name of the wrappers-useragent.
     * @return SpigetAPI
     */
    public static function getInstance( $useragent = 'Spiget4PHP' )
    {
        if (is_null(SpigetAPI::$instance)) {
            SpigetAPI::$instance = new SpigetAPI($useragent);
        }
        return SpigetAPI::$instance;
    }

}
