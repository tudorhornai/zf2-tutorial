<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Feed_Pubsubhubbub
 * @subpackage Entity
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @namespace
 */
namespace Zend\Feed\PubSubHubbub\Model;
use Zend\Feed\PubSubHubbub;
use Zend\Date;

/**
 * @uses       \Zend\Date\Date
 * @uses       \Zend\Feed\PubSubHubbub\Exception
 * @uses       \Zend\Feed\PubSubHubbub\Model\AbstractModel
 * @uses       \Zend\Feed\PubSubHubbub\Model\SubscriptionPersistence
 * @category   Zend
 * @package    Zend_Feed_Pubsubhubbub
 * @subpackage Entity
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Subscription extends AbstractModel implements SubscriptionPersistence
{
    
    /**
     * Save subscription to RDMBS
     *
     * @param array $data
     * @return bool
     */
    public function setSubscription(array $data)
    {
        if (!isset($data['id'])) {
            throw new PubSubHubbub\Exception(
                'ID must be set before attempting a save'
            );
        }
        $result = $this->_db->select(array('id' => $data['id']));
        if ($result && (0 < count($result))) {
            $data['created_time'] = $result->current()->created_time;
            $now = new Date\Date;
            if (array_key_exists('lease_seconds', $data) 
                && $data['lease_seconds']
            ) {
                $data['expiration_time'] = $now->add($data['lease_seconds'], Date\Date::SECOND)
                ->get('yyyy-MM-dd HH:mm:ss');
            }
            $this->_db->update(
                $data,
                array('id' => $data['id'])
            );
            return false;
        }

        $this->_db->insert($data);
        return true;
    }
    
    /**
     * Get subscription by ID/key
     * 
     * @param  string $key 
     * @return array
     */
    public function getSubscription($key)
    {
        if (empty($key) || !is_string($key)) {
            throw new PubSubHubbub\Exception('Invalid parameter "key"'
                .' of "' . $key . '" must be a non-empty string');
        }
        $result = $this->_db->select(array('id' => $key));
        if (count($result)) {
            return $result->current()->getArrayCopy();
        }
        return false;
    }

    /**
     * Determine if a subscription matching the key exists
     * 
     * @param  string $key 
     * @return bool
     */
    public function hasSubscription($key)
    {
        if (empty($key) || !is_string($key)) {
            throw new PubSubHubbub\Exception('Invalid parameter "key"'
                .' of "' . $key . '" must be a non-empty string');
        }
        $result = $this->_db->select(array('id' => $key));
        if (count($result)) {
            return true;
        }
        return false;
    }

    /**
     * Delete a subscription
     *
     * @param string $key
     * @return bool
     */
    public function deleteSubscription($key)
    {
        $result = $this->_db->select(array('id' => $key));
        if (count($result)) {
            $this->_db->delete(
                array('id' => $key)
            );
            return true;
        }
        return false;
    }

}