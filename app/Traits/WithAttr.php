<?php

namespace app\Traits;

use Shopwwi\WebmanAuth\Facade\Auth;

trait WithAttr
{
    /**
     * @var string
     */
    protected string $parentIdColumn = 'parent_id';

    /**
     * @var string
     */
    protected string $sortField = 'sort';

    /**
     * @var bool
     */
    protected bool $sortDesc = true;


    /**
     * columns which show in list
     *
     * @var array
     */
    protected array $fields = [];


    /**
     * @var array
     */
    protected array $form = [];

    /**
     * @var array
     */
    protected array $formRelations = [];

    /**
     * @var bool
     */
    protected bool $dataRange = false;

    /**
     *
     * @param string $parentId
     * @return $this
     */
    public function setParentIdColumn(string $parentId): static
    {
        $this->parentIdColumn = $parentId;

        return $this;
    }

    /**
     *
     * @param string $sortField
     * @return $this
     */
    protected function setSortField(string $sortField): static
    {
        $this->sortField = $sortField;

        return $this;
    }
    /**
     *
     * @return $this
     */
    protected function setCreatorId(): static
    {
        $this->setAttribute($this->getCreatorIdColumn(), Auth::guard('admin_api')->id());

        return $this;
    }

    public function getCreatorIdColumn(): string
    {
        return 'creator_id';
    }

    public function getFields(): array
    {
        return $this->fields;
    }
    /**
     *
     * @return $this
     */
    protected function setPaginate(bool $isPaginate = true): static
    {
        $this->isPaginate = $isPaginate;

        return $this;
    }

    /**
     * whit form data
     *
     * @return $this
     */
    public function withoutForm(): static
    {
        if (property_exists($this, 'form') && !empty($this->form)) {
            $this->form = [];
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getForm(): array
    {
        if (property_exists($this, 'form') && !empty($this->form)) {
            return $this->form;
        }

        return [];
    }

    /**
     * get parent id
     *
     * @return string
     */
    public function getParentIdColumn(): string
    {
        return $this->parentIdColumn;
    }

    /**
     *
     * @return array
     */
    public function getFormRelations(): array
    {
        if (property_exists($this, 'formRelations') && !empty($this->form)) {
            return $this->formRelations;
        }

        return [];
    }

    /**
     * set data range
     *
     * @param bool $use
     * @return $this
     */
    public function setDataRange(bool $use = true): static
    {
        $this->dataRange = $use;

        return $this;
    }
    public function getAsTree(): bool
    {
        return $this->asTree;
    }
    public function getDataRange() :bool
    {
        return $this->dataRange;
    }
}