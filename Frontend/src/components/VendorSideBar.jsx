import React from 'react'
import { CgProfile } from "react-icons/cg";
import { CiSettings } from "react-icons/ci";
import { HiBriefcase } from "react-icons/hi";
import { MdSubscriptions , MdHome } from "react-icons/md";
import { Link } from 'react-router-dom';
import { LogOut } from 'lucide-react';

function VendorSideBar() {
  return (
    <aside className='w-40 h-[calc(100%-50px)] fixed mt-[60px] left-0 border-white border-r-2'>

      <div className='flex flex-col w-full justify-around bg-green-600 h-full'>
      <Link to='/vendor-management'>
      <div className='text-white flex p-3 items-center justify-evenly
           hover:bg-green-800 hover:self-end rounded-b-2xl hover:text-[17px]'>
            <MdHome size={38} />Home
            </div>
        </Link>
        <Link to='/vendor-management/profile'>
          <div className='text-white flex p-3 items-center justify-evenly
           hover:bg-green-800 hover:self-end rounded-b-2xl hover:text-[17px]'>
            <CgProfile size={38} />Profile</div>
        </Link>
        <Link to='/vendor-management/setting'>
          <div className='text-white flex p-3 items-center justify-evenly
           hover:bg-green-800 hover:self-end rounded-b-2xl hover:text-[17px]'>
            <CiSettings size={38} />Setting</div>
        </Link>
        <Link to='/vendor-management/my-products'>
          <div className='text-white flex p-3 items-center justify-evenly text-[13px]
           hover:bg-green-800 hover:self-end rounded-b-2xl hover:text-[16px]'>
            <HiBriefcase size={33} />My-Products</div>
        </Link>
        <Link to='/vendor-management/subscription'>
          <div className='text-white flex p-3 items-center justify-evenly text-[14px]
           hover:bg-green-800 hover:self-end rounded-b-2xl hover:text-[17px]'>
          <MdSubscriptions size={38} />Asbeza</div>
        </Link>
        <Link to='/vendor-management/subscription'>
          <div className='text-white flex p-3 items-center justify-evenly text-[15px]
           hover:bg-green-800 hover:self-end rounded-b-2xl hover:text-[17px]'>
        <LogOut size={38}/>Log Out</div>
        </Link>
      </div>
    </aside>
  )
}

export default VendorSideBar