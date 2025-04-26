import React from 'react'
import { Link } from 'react-router-dom'
import { Settings, Tag, Menu, Bell, ShoppingCart, Search, Package } from 'lucide-react';

import { PiSignOutThin } from "react-icons/pi";
function VendorNavBar() {

  return (
    <nav className='fixed bg-green-600 w-full h-15 z-20 top-0 '>
       <header className="bg-white shadow-sm">
          <div className="flex items-center justify-between px-8 py-4">
            <div className='flex items-center gap-2'>
            <Menu size={25}/>
            <span className='text-green-600 text-xl font-bold'>
              Fresh Mart
            </span>
            </div>
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
              <button className='p-2.5 bg-white rounded-3xl flex justify-around items-center'>
                <Link to='/vendor-management/product-post'>Post Product</Link>
                <PiSignOutThin size={24}/>
            </button>
            </div>
          </div>
          </header>
       
    </nav>
  )
}

export default VendorNavBar