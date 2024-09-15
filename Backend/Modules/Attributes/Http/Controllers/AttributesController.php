<?php

namespace Modules\Attributes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Http\Requests\StoreAttributeRequest;
use Modules\Attributes\Http\Requests\UpdateAttributeRequest;
use Modules\Attributes\Repositories\AttributeRepositoryInterface;
use Modules\Attributes\Transformers\AttributeResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;

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
        try {
            $attribute = $this->attributeRepository->create($request->validated());
            return response()->json([
                'message' => 'Attribute created successfully',
                'data' => new AttributeResource($attribute)
            ], Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Attribute name already exists'], Response::HTTP_CONFLICT);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create attribute'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $attribute = $this->attributeRepository->find($id);
            return new AttributeResource($attribute);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Attribute not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        try {
            $attribute = $this->attributeRepository->update($id, $request->validated());
            return response()->json([
                'message' => 'Attribute updated successfully',
                'data' => new AttributeResource($attribute)
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Attribute name already exists'], Response::HTTP_CONFLICT);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update attribute'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $this->attributeRepository->delete($id);
            return response()->json(['message' => 'Attribute deleted successfully'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete attribute'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}