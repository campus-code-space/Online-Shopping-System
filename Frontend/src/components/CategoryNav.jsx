import React from 'react'
import { Link } from 'react-router-dom'
import CategoryItem from './CategoryItem'
function CategoryNav() {
    const CATEGORIES = [{name:"All Items",sub:['packed']},{name:"Fruits",sub:['packed','unpacked']},
    {name:"Vegetables",sub:['packed','not packed']},{name:"Salon",sub:['packed','unpacked']},
    {name:"Bakery",sub:['packed','not packed']},{name:"Diary",sub:['packed','unpacked']},
    ,{name:"Beverage",sub:['packed','unpacked']}
    ];
  return (
    <nav className="px-8 py-3 border-b w-full">
    <ul className="flex space-x-6">
     {
        CATEGORIES.map((category,index)=>{
            return <ul><CategoryItem item={category.name} sub={category.sub}key={index}/></ul>
        })
     }
    </ul>
  </nav>
  )
}

export default CategoryNav