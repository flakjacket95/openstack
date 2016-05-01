<?php declare (strict_types=1);

namespace OpenStack\Identity\v3\Models;

use OpenCloud\Common\Resource\OperatorResource;
use OpenCloud\Common\Resource\Creatable;
use OpenCloud\Common\Resource\Deletable;
use OpenCloud\Common\Resource\Listable;
use OpenCloud\Common\Resource\Retrievable;
use OpenCloud\Common\Resource\Updateable;

/**
 * @property \OpenStack\Identity\v3\Api $api
 */
class Policy extends OperatorResource implements Creatable, Listable, Retrievable, Updateable, Deletable
{
    /** @var string */
    public $blob;

    /** @var string */
    public $id;

    /** @var array */
    public $links;

    /** @var string */
    public $projectId;

    /** @var string */
    public $type;

    /** @var string */
    public $userId;

    protected $aliases = [
        'project_id' => 'projectId',
        'user_id'    => 'userId'
    ];

    /**
     * {@inheritDoc}
     *
     * @param array $data {@see \OpenStack\Identity\v3\Api::postPolicies}
     */
    public function create(array $data): Creatable
    {
        $response = $this->execute($this->api->postPolicies(), $data);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getPolicy(), ['id' => $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function update()
    {
        $response = $this->executeWithState($this->api->patchPolicy());
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deletePolicy(), ['id' => $this->id]);
    }
}
