<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity
 *
 * @property int $id
 * @property string|null $text
 * @property bool|null $status
 */
class Notification extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'text' => true,
        'status' => true
    ];

    public function insertNotification_New_Media_Playlist($user=null, $Playlist=null, $order=null) {
        if ($user->is_us()):
         $text="User ".$user->firstname." ".$user->lastname." Just add new Media in Playlist ".$Playlist;
         $notification = \Cake\ORM\TableRegistry::get('notifications')->newEntity();
         $notification->text=$text;
         $notification->status=false;
         \Cake\ORM\TableRegistry::get('notifications')->save($notification); 
     endif;
    }
}
