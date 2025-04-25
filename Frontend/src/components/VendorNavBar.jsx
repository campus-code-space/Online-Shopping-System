import React from 'react'
import { Link } from 'react-router-dom'
function VendorNavBar() {

  return (
    <nav className='fixed bg-green-600 w-full h-15 z-20 top-0 '>
        <div className='flex justify-end items-center h-full'>
            <button className='p-2 bg-white rounded-3xl text-green-600'>
                <Link to='/vendor-management/product-post'>Post Product</Link>
            </button>
        </div>
    </nav>
  )
}

export default VendorNavBar