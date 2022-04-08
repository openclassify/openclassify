<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePreferencesUpdateUserRelatedConfig
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePreferencesUpdateUserRelatedConfig extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* @var \Anomaly\Streams\Platform\Field\Contract\FieldInterface $field */
        $field = $this->fields()->findBySlugAndNamespace('user', 'preferences');

        $field->config = [
            'mode'    => 'lookup',
            'related' => 'Anomaly\UsersModule\User\UserModel',
        ];

        $field->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* @var \Anomaly\Streams\Platform\Field\Contract\FieldInterface $field */
        $field = $this->fields()->findBySlugAndNamespace('user', 'preferences');

        $field->config = [
            'mode'    => 'lookup',
            'related' => 'Anomaly\UsersModule\User\UserModel',
        ];

        $field->save();
    }
}
