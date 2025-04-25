import React from 'react'
import { Link } from 'react-router-dom'
import CategoryItem from './CategoryItem';
import { CATEGORIES } from '../helper/categories';
const categories = CATEGORIES;
function CategoryNav() {
    
  return (
    <nav className="px-8 py-3 border-b w-full">
    <ul className="flex space-x-6">
     {
        categories.map((category,index)=>{
            return <ul><CategoryItem item={category.name} sub={category.sub}key={index}/></ul>
        })
     }
    </ul>
  </nav>
  )
}

export default CategoryNav