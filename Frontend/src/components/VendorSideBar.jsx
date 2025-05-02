import React from 'react'
import { CgProfile } from "react-icons/cg";
import { CiSettings } from "react-icons/ci";
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { HiBriefcase } from "react-icons/hi";
import { MdSubscriptions , MdHome } from "react-icons/md";
import { Link } from 'react-router-dom';
import { LogOut } from 'lucide-react';

function VendorSideBar() {
  const [showLogoutConfirm, setShowLogoutConfirm] = useState(false);
  const  navigate = useNavigate();

  const handleLogoutClick = () => {
    setShowLogoutConfirm(true);
  };
  
  const confirmLogout = () => {
    console.log("Logged out");
    localStorage.removeItem('userdata');
    setShowLogoutConfirm(false);
    navigate('/');
  };
  const cancelLogout = () => {
    setShowLogoutConfirm(false);
  };
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
          <div className='text-white flex p-3 items-center justify-evenly text-[15px]
           hover:bg-green-800 hover:self-end rounded-b-2xl hover:text-[18px]'>
          <MdSubscriptions size={38} />Asbeza</div>
        </Link>
        
          <div  
          onClick={handleLogoutClick}
          className='text-white cursor-pointer flex p-3 items-center justify-evenly text-[15px]
           hover:bg-green-800  rounded-b-2xl hover:text-[17px]'>
            <LogOut size={38}/>Log Out</div>
        
      </div>
      {showLogoutConfirm && (
        <div className="fixed inset-0 bg-green-900 bg-opacity-90 flex justify-center items-center z-50">
          <div className="bg-white p-6 rounded shadow-lg text-center">
            <p className="text-lg mb-4">Are you sure you want to log out?</p>
            <div className="flex justify-around">
              <button onClick={confirmLogout} className="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">Yes</button>
              <button onClick={cancelLogout} className="bg-gray-300 px-4 py-2 rounded-xl hover:bg-gray-400">Cancel</button>
            </div>
          </div>
        </div>
      )}
    </aside>
  )
}

export default VendorSideBar