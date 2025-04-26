import React from 'react'
import { Outlet } from 'react-router-dom';
import VendorSideBar from '../components/VendorSideBar';
import VendorNavBar from '../components/VendorNavBar';
import CategoryNav from '../components/CategoryNav';

function VendorPage() {

  return (
    <div>
      <VendorNavBar />
      <VendorSideBar />
      <div className='mt-[60px] ml-[150px] inline-flex w-[calc(100vw-169px)] p-1.5 rounded-tl-2xl'>
        <CategoryNav />
      </div>
      <Outlet />
    </div>
  )
}

export default VendorPage;