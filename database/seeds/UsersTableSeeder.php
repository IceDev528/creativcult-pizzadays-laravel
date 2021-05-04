<?php

use Illuminate\Database\Seeder;

class UsersGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
			    [		'id' 			=> '1',
			    		'email' 		=> 'admin@admin.com',
			    		'password' 		=> bcrypt('admin'),
			    		'permissions' 	=> '{"home.dashboard":true}',
			    		'first_name' 			=> 'John',
			    		'last_name' 		=> 'Doe'
			    		
			    ],
			    [		'id' 			=> '2',
			    		'email' 		=> 'manager@manager.com',
			    		'password' 		=> bcrypt('manager'),
			    		'permissions' 	=> '{"home.dashboard":true}',
			    		'first_name' 			=> 'John',
			    		'last_name' 		=> 'Manager'
			    		
			    ]

			]);
         DB::table('roles')->insert([
			    [		
			    		'id'=>'1',
			    		'slug' 		=> 'admin',
			    		'name' 			=> 'Admin',
			    		'permissions' 	=> '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.permissions":true,"user.save":true,"user.activate":true,"user.deactivate":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.save":true,"location.index":true,"location.create":true,"location.store":true,"location.show":true,"location.edit":true,"location.update":true,"location.destroy":true,"zipcode.index":true,"zipcode.create":true,"zipcode.store":true,"zipcode.show":true,"zipcode.edit":true,"zipcode.update":true,"zipcode.destroy":true,"category.index":true,"category.create":true,"category.store":true,"category.show":true,"category.edit":true,"category.update":true,"category.destroy":true,"attribute.index":true,"attribute.create":true,"attribute.store":true,"attribute.show":true,"attribute.edit":true,"attribute.update":true,"attribute.destroy":true,"product.index":true,"product.create":true,"product.store":true,"product.show":true,"product.edit":true,"product.update":true,"product.destroy":true,"appsetting.index":true,"appsetting.create":true,"appsetting.store":true,"appsetting.show":true,"appsetting.edit":true,"appsetting.update":true,"appsetting.destroy":true,"order.index":true,"order.create":true,"order.store":true,"order.show":true,"order.edit":true,"order.update":true,"order.destroy":true,"transaction.index":true,"transaction.create":true,"transaction.store":true,"transaction.show":true,"transaction.edit":true,"transaction.update":true,"transaction.destroy":true,"cartcheck.index":true,"cartcheck.create":true,"cartcheck.store":true,"cartcheck.show":true,"cartcheck.edit":true,"cartcheck.update":true,"cartcheck.destroy":true,"notification.index":true,"notification.create":true,"notification.store":true,"notification.show":true,"notification.edit":true,"notification.update":true,"notification.destroy":true,"voucher.index":true,"voucher.create":true,"voucher.store":true,"voucher.show":true,"voucher.edit":true,"voucher.update":true,"voucher.destroy":true}',
			    ],
			    [		
			    		'id'=>'2',
			    		'slug' 		=> 'client',
			    		'name' 			=> 'Client',
			    		'permissions' 			=> '{"home.dashboard":false}',
			    ],
			    [		
			    		'id'=>'3',
			    		'slug' 		=> 'manager',
			    		'name' 			=> 'Manager',
			    		'permissions' 			=> '{"home.dashboard":true,"user.index":true,"user.show":true,"product.index":true,"product.show":true,"order.index":true,"order.show":true,"order.edit":true,"order.update":true,"transaction.index":true,"transaction.show":true,"cartcheck.index":true,"cartcheck.show":true,"order.StatusEnableDesable":true}',
			    ],
			    [		
			    		'id'=>'4',
			    		'slug' 		=> 'cashier',
			    		'name' 			=> 'Cashier',
			    		'permissions' 			=> '{"home.dashboard":true}',
			    ],
			    [		
			    		'id'=>'5',
			    		'slug' 		=> 'call_center',
			    		'name' 			=> 'Call Center',
			    		'permissions' 			=> '{"home.dashboard":true}',
			    ]
		 ]);
		 DB::table('role_users')->insert([
			    [		
			    		'user_id' 		=> '1',
			    		'role_id' 			=> '1',
			    ],
			    [		
			    		'user_id' 		=> '2',
			    		'role_id' 			=> '3',
			    ]
		 ]);
		 DB::table('activations')->insert([
			    [		
			    		'user_id' 		=> '1',
			    		'code' 			=> '1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP',
			    		'completed' 			=> '1',
			    ],
			    [		
			    		'user_id' 		=> '2',
			    		'code' 			=> '1S4u7lJzehk62xDm3DgYgXXYWtbHE6sgSP',
			    		'completed' 			=> '1',
			    ]
		 ]);
		 DB::table('locations')->insert([
			    [		
			    		'id' 		=> '1',
			    		'name' 			=> 'Fulda',
			    ]
		 ]);
		 DB::table('zipcodes')->insert([
			    [		
			    		'id' 		=> '1',
			    		'name' 			=> '36124',
			    		'location_id' 			=> '1',
			    ]
		 ]);
		 DB::table('categories')->insert([
			    [		
			    		'id' 		=> '1',
			    		'name' 			=> 'Pizza',
			    		'slug' 			=> 'pizza',
			    		'is_parent' 	=> '1',
			    ],
			    [		
			    		'id' 		=> '2',
			    		'name' 			=> 'Pasta',
			    		'slug' 			=> 'pasta',
			    		'is_parent' 	=> '1',
			    ],
			    [		
			    		'id' 		=> '3',
			    		'name' 			=> 'Dessert',
			    		'slug' 			=> 'dessert',
			    		'is_parent' 	=> '1',
			    ]
		 ]);
		 DB::table('attributes')->insert([
			    [		
			    		'id' 		=> '1',
			    		'name' 			=> 'Small',
			    		
			    ],
			    [		
			    		'id' 		=> '2',
			    		'name' 			=> 'Medium',
			    ],
			    [		
			    		'id' 		=> '3',
			    		'name' 			=> 'Large',
			    ]
		 ]);
		 
		 DB::table('products')->insert([
			    [		
			    		'id' 		=> '1',
			    		'name' 			=> 'Pizza Name 1',
			    		'slug' 			=> 'pizza-name-1',
			    		'category_id' 			=> '1',
			    		'description' 			=> 'Lorem ipsum Pizza 1 dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod',
			    		'image' 			=> 'pizzamenu.png',
			    		'path' 			=> '/frontend/img/',
			    		
			    ],
			    [		
			    		'id' 		=> '2',
			    		'name' 			=> 'Pizza Name 2',
			    		'slug' 			=> 'pizza-name-2',
			    		'category_id' 			=> '1',
			    		'description' 			=> 'Lorem ipsum Pizza 2 dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod',
			    		'image' 			=> 'pizzamenu1.png',
			    		'path' 			=> '/frontend/img/',
			    		
			    ],
			    [		
			    		'id' 		=> '3',
			    		'name' 			=> 'Pasta Name 1',
			    		'slug' 			=> 'pasta-name-1',
			    		'category_id' 			=> '2',
			    		'description' 			=> 'Lorem ipsum dolor  Pasta 1sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod',
			    		'image' 			=> 'Pasta_plate.png',
			    		'path' 			=> '/frontend/img/',
			    		
			    ],
			     [		
			    		'id' 		=> '4',
			    		'name' 			=> 'Pasta Name 2',
			    		'slug' 			=> 'pasta-name-2',
			    		'category_id' 			=> '2',
			    		'description' 			=> 'Lorem ipsum dolor s Pasta 2 it amet, consetetur sadipscing elitr, sed diam nonumy eirmod',
			    		'image' 			=> 'info-pastabowl-2.png',
			    		'path' 			=> '/frontend/img/',
			    		
			    ],
			    [		
			    		'id' 		=> '5',
			    		'name' 			=> 'Dessert Name 1',
			    		'slug' 			=> 'dessert-name-1',
			    		'category_id' 			=> '3',
			    		'description' 			=> 'Lorem ipsum dolor  Dessert 1 sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod',
			    		'image' 			=> 'dessert1.png',
			    		'path' 			=> '/frontend/img/',
			    		
			    ],
			     [		
			    		'id' 		=> '6',
			    		'name' 			=> 'Dessert Name 2',
			    		'slug' 			=> 'dessert-name-2',
			    		'category_id' 			=> '3',
			    		'description' 			=> 'Lorem ipsum dolor sit Dessert 2 amet, consetetur sadipscing elitr, sed diam nonumy eirmod',
			    		'image' 			=> 'dessert2.png',
			    		'path' 			=> '/frontend/img/',
			    		
			    ],
		 ]);

		  DB::table('attribute_product')->insert([
			    [		
			    		'product_id' 		=> '1',
			    		'attribute_id' 			=> '1',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '1',
			    		'attribute_id' 			=> '2',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '1',
			    		'attribute_id' 			=> '3',
			    		'price' 			=> '8.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '2',
			    		'attribute_id' 			=> '1',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '2',
			    		'attribute_id' 			=> '2',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '2',
			    		'attribute_id' 			=> '3',
			    		'price' 			=> '8.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '3',
			    		'attribute_id' 			=> '1',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '3',
			    		'attribute_id' 			=> '2',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '3',
			    		'attribute_id' 			=> '3',
			    		'price' 			=> '8.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '4',
			    		'attribute_id' 			=> '1',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '4',
			    		'attribute_id' 			=> '2',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '4',
			    		'attribute_id' 			=> '3',
			    		'price' 			=> '8.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '5',
			    		'attribute_id' 			=> '1',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '5',
			    		'attribute_id' 			=> '2',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '5',
			    		'attribute_id' 			=> '3',
			    		'price' 			=> '8.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '6',
			    		'attribute_id' 			=> '1',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '6',
			    		'attribute_id' 			=> '2',
			    		'price' 			=> '5.6',
			    		
			    ],
			    [		
			    		'product_id' 		=> '6',
			    		'attribute_id' 			=> '3',
			    		'price' 			=> '8.6',
			    		
			    ],


		 ]);

		 
		 
    }
}
