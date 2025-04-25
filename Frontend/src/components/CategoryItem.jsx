import React from 'react'
import { Link } from 'react-router-dom'
function CategoryItem({item}) {
  return (
      <Link to={`/${item}`} className="p-1.5 text-gray-600 hover:text-green-600">{item}</Link>
  )
}

export default CategoryItem