# Overview

This small API is intended to demonstrate the utility of Laravel's built in API tools. 

---
## Routing
All routes are served through the `api.php` route file, and thus automatically piped through API middleware. I have not taken the time to add Authentication, but standard JWT auth using an Oath2.0 provider like Passport could be done through a middleware here. 

#### Resource API Routes
Laravel's API resource routes are used heavily to simplify the routing file. The following line serves four different routes and methods.

`Route::resource('school', 'SchoolController');`

#### Route Model Binding
I have also heavily used implicit route model binding to eager load models straight from request. This speeds up development and performance, though it could benefit from additional error messaging (a non-present model will produce a simple 404 response).

	public function show(School $school): SchoolResource
	{
		return new SchoolResource($school);
	}
            
---
## API Resources 
All non-file responses are served to the User using Laravel's API resources. This allows customization of a model's `toArray()`, and enforces desired response structure in a reusable fashion. 

#### Dynamic Response Composition
API resources also allow for dynamic composition of payloads, for instance `products` will only be added to the `school` response when they have been loaded:

	'products' => ProductResource::collection($this->whenLoaded('products'))
	
#### Loading Data from Pivot Tables

This behavior can also be used to load pivot relationship data. For instance `price` will only be returned when the `school_products` pivot has been loaded.

	'price' => $this->whenPivotLoaded('school_products', function () {
                return $this->pivot->price;
            }),

---
## Modeling and Database
The database consists of only three simple tables:

	1. schools
	2. products
	3. school_products
	
These three tables correspond to two standard Laravel models with a `many-to-many` relationship between them. 

#### Value Optimization
Given that we want to query the `product->value` frequently which depends on the `school->circulation`, I decided to store this information in the `school_products` pivot. This allows for rapid access and performs the necessary calculation `$price/$circulation` up front rather than on page load. 

The value attribute is updated by accessing the pivot on sync.

	 $school->products()->syncWithoutDetaching([
		$product->id => [
			'price' => $request->get('price'),
			'value' => $request->get('price')/$school->circulation
		]
	]);

---
## Filters
I have frequently used a `filter` and `scope` convention to achieve dynamic filtering of models. I chose to implement this structure here as well, mostly as an example. 

This requires setting up a `scope` on the model: 

	public function scopeFilter(Builder $query, SchoolFilter $filters)
	{
		return $filters->apply($query);
	}

And building a corresponding filter class. For `School` this can be found at `SchoolFilter`. Adding additional filters to the school requires editing only this `SchoolFilter` class. 

---
## Testing
My next step would probably be to finish composing `phpunit` tests for all of the above structure. I prefer a test driven approach with significant coverage, but due to time limitations I have only built partial coverage for controllers.

These existing tests can be run from `phpunit` and should verify that the app is functioning properly at a basic level. 
