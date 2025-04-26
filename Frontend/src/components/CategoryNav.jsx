import React from 'react'
import { Link } from 'react-router-dom'
import CategoryItem from './CategoryItem';
import { CATEGORIES } from '../helper/categories';
const categories = CATEGORIES;
function CategoryNav() {
    
  return (
    <nav className="px-8 py-3 border-b w-full rounded-2xl">
    <ul className="flex space-x-7 rounded-tl-2xl items-center h-13">
     {
        categories.map((category,index)=>{
            return <ul key={index} className='border-1 rounded-xl py-1  hover:bg-green-600'>
              <CategoryItem item={category.name} sub={category.sub} key={index}/>
              </ul>
        })
     }
    </ul>
  </nav>
  )
}

export default CategoryNav