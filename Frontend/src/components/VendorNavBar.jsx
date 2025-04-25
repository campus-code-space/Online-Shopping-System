import React from 'react'
import { Link } from 'react-router-dom'
function VendorNavBar() {

  return (
    <nav className='fixed bg-blue-200 w-full h-15 z-20 top-0 '>
        <div className='flex justify-end items-center text-white h-full'>
            <button className='p-2 bg-green-600 rounded-3xl'>
                <Link to='/vendor-management/product-post'>Post Product</Link>
            </button>
        </div>
    </nav>
  )
}

export default VendorNavBar