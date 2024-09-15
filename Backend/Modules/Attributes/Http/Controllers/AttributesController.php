<?php

namespace Modules\Attributes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Http\Requests\StoreAttributeRequest;
use Modules\Attributes\Http\Requests\UpdateAttributeRequest;
use Modules\Attributes\Repositories\AttributeRepositoryInterface;
use Modules\Attributes\Transformers\AttributeResource;

class AttributesController extends Controller
{
    protected $attributeRepository;

    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function index()
    {
        return AttributeResource::collection($this->attributeRepository->getAll());
    }

    public function store(StoreAttributeRequest $request)
    {
        $attribute = $this->attributeRepository->create($request->validated());
        return new AttributeResource($attribute);
    }

    public function show($id)
    {
        return new AttributeResource($this->attributeRepository->find($id));
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        $attribute = $this->attributeRepository->update($id, $request->validated());
        return new AttributeResource($attribute);
    }

    public function destroy($id)
    {
        $this->attributeRepository->delete($id);
        return response()->json(null, 204);
    }
}