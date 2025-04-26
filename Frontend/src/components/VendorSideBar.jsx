import React from 'react'
import { CgProfile } from "react-icons/cg";
import { CiSettings } from "react-icons/ci";
import { HiBriefcase } from "react-icons/hi";
import { MdSubscriptions } from "react-icons/md";
import { Link } from 'react-router-dom';
function VendorSideBar() {
  return (
    <aside className='w-40 h-[calc(100%-50px)] fixed mt-[60px] left-0 border-white border-r-2'>

      <div className='flex flex-col w-full justify-around bg-green-600 h-full'>
        <Link to='/vendor-managment/profile'>
          <div className='text-white flex p-3 items-center justify-evenly
           hover:bg-green-800 hover:self-end'>
            <CgProfile size={40} />Profile</div>
        </Link>
        <Link to='/vendor-managment/setting'>
          <div className='text-white flex p-3 items-center justify-evenly
           hover:bg-green-800'>
            <CiSettings size={40} />Setting</div>
        </Link>
        <Link to='/vendor-managment/my-products'>
          <div className='text-white flex p-3 items-center justify-evenly text-[15px]
           hover:bg-green-800'>
            <HiBriefcase size={40} />My-Products</div>
        </Link>
        <Link to='/vendor-managment/subscription'>
          <div className='text-white flex p-3 items-center justify-evenly text-[15px]
           hover:bg-green-800'>
          <MdSubscriptions size={40} />Subscription</div>
        </Link>
      </div>
    </aside>
  )
}

export default VendorSideBar