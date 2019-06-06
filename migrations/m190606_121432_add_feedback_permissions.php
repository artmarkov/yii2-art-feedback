<?php

use artsoft\db\PermissionsMigration;

class m190606_121432_add_feedback_permissions extends PermissionsMigration
{

    public function beforeUp()
    {
        $this->addPermissionsGroup('feedbackManagement', 'Feedback Management');
    }

    public function afterDown()
    {
        $this->deletePermissionsGroup('feedbackManagement');
    }

    public function getPermissions()
    {
        return [
            'feedbackManagement' => [
                'links' => [
                    '/admin/feedback/*',
                    '/admin/feedback/default/*',
                ],
                'viewFeedbacks' => [
                    'title' => 'View Feedbacks',
                    'links' => [
                        '/admin/feedback/default/index',
                        '/admin/feedback/default/view',
                        '/admin/feedback/default/grid-page-size',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                ],
                'editFeedbacks' => [
                    'title' => 'Edit Feedbacks',
                    'links' => [
                        '/admin/feedback/default/update',                        
                        '/admin/feedback/default/bulk-activate',
                        '/admin/feedback/default/bulk-deactivate',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewFeedbacks',
                    ],
                ],
                'createFeedbacks' => [
                    'title' => 'Create Feedbacks',
                    'links' => [
                        '/admin/feedback/default/create',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewFeedbacks',
                    ],
                ],
                'deleteFeedbacks' => [
                    'title' => 'Delete Feedbacks',
                    'links' => [
                        '/admin/feedback/default/delete',
                        '/admin/feedback/default/bulk-delete',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewFeedbacks',
                    ],
                ],
                'fullFeedbackAccess' => [
                    'title' => 'Full Feedback Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                ],                
            ],
        ];
    }

}
