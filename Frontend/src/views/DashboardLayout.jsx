import React, { useContext, useState } from 'react';
import { Link } from 'react-router-dom';
import { Settings, Tag, MapPin, Bell, ShoppingCart, Search, Package } from 'lucide-react';
import Data from '../../Data.json'
import { cartContext } from '../context/contextProvider';
import { getUserRole } from '../auth/auth';
import CategoryNav from '../components/CategoryNav';

export default function DashboardLayout() {
  const [products,setproducts]= useState(Data.products)
  const {dispatch} = useContext(cartContext);
  const {cart} = useContext(cartContext);

  const role = getUserRole();
  console.log(role);
  return (
    <div className="flex h-screen bg-gray-100">
      {/* Sidebar */}
      <aside className="w-64 bg-white shadow-md flex flex-col items-center py-8">
        <div className="w-24 h-24 bg-gray-200 rounded-full mb-6"></div>
        <nav className="w-full">
          <Link 
            to="/settings"
            className="flex items-center px-8 py-3 hover:bg-gray-50"
          >
            <Settings className="w-5 h-5 mr-3" />
            <span>Setting</span>
          </Link>
          <Link 
            to="/discounts"
            className="flex items-center px-8 py-3 hover:bg-gray-50"
          >
            <Tag className="w-5 h-5 mr-3" />
            <span>Discount</span>
          </Link>
          <Link 
            to="/markets"
            className="flex items-center px-8 py-3 hover:bg-gray-50"
          >
            <MapPin className="w-5 h-5 mr-3" />
            <span>Markets Nearby</span>
          </Link>
          <Link 
            to="/bulkSubscription"
            className="flex items-center px-8 py-3 hover:bg-gray-50"
          >
            <Package className="w-5 h-5 mr-3" />
            <span>Bulk Subscription</span>
          </Link>
        </nav>
      </aside>

      {/* Main Content */}
      <main className="flex-1">
        {/* Top Bar */}
        <header className="bg-white shadow-sm">
          <div className="flex items-center justify-between px-8 py-4">
            <div className="flex-1 max-w-2xl flex items-center gap-2">
              <div className="relative flex-1">
                <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
                <input
                  type="text"
                  placeholder="Search products..."
                  className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500"
                />
              </div>
              <button className="bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 transition-colors flex items-center gap-2">
                <Search className="w-4 h-4" />
                <span>Search</span>
              </button>
            </div>
            <div className="flex items-center space-x-4">
              <button className="relative p-2 hover:bg-gray-100 rounded-full">
                <Bell className="w-6 h-6" />
                <span className="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
              </button>
              <Link to="/CartPage"className="relative p-2 hover:bg-gray-100 rounded-full">
                <ShoppingCart className="w-6 h-6" />
                <span className="absolute top-0 right-0 w-5 h-5 bg-green-500 text-white text-xs flex items-center justify-center rounded-full">{cart.reduce((total, item) => total + item.quantity, 0)}</span>
              </Link>
            </div>
          </div>

          {/* Category Navigation */}
         <CategoryNav/>
        </header>

        {/* Product Grid */}
        <div className="p-8">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {/* Sample Product Cards */}
            {products.map((item ,index)=> (
              <div key={index} className="bg-white rounded-lg shadow-sm overflow-hidden">
                <div className="h-48 bg-gray-200"></div>
                <div className="p-4">
                  <h3 className="font-medium">{item.title}</h3>
                  <p className="text-sm text-gray-500 mb-2">Category</p>
                  <div className="flex items-center justify-between">
                    <span className="font-bold text-green-600">${item.price}</span>
                    <button className="bg-green-600 text-white px-3 py-1 rounded-full text-sm hover:bg-green-700" onClick={()=> dispatch({type: "Add",item})}>
                      Add to Cart
                    </button>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </main>
    </div>
  );
}