import React from 'react'
import { Link } from 'react-router-dom'
import CategoryItem from './CategoryItem'
function CategoryNav() {
    const CATEGORIES = ["All Items","Fruits","Vegetables","Meat","Dairy","Bakery","Beverages"];
  return (
    <nav className="px-8 py-3 border-b w-full">
    <ul className="flex space-x-6">
     {
        CATEGORIES.map((item,index)=>{
            return <li><CategoryItem item={item} key={index}/></li>
        })
     }
    </ul>
  </nav>
  )
}

export default CategoryNav