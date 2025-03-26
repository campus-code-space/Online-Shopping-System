import React from 'react';
import { Link } from 'react-router-dom';
import { Tag, ArrowLeft, Percent, Clock, ShoppingBag } from 'lucide-react';

export default function DiscountPage() {
  const discounts = [
    {
      title: "Weekend Special",
      description: "20% off on all fresh fruits and vegetables",
      code: "FRESH20",
      validUntil: "2024-04-30",
      category: "Produce",
      discount: "20%"
    },
    {
      title: "First Order Discount",
      description: "Get $15 off on your first order above $50",
      code: "WELCOME15",
      validUntil: "2024-12-31",
      category: "All Categories",
      discount: "$15"
    },
    {
      title: "Bulk Buy Offer",
      description: "Save 25% when you buy 5 or more items from our dairy section",
      code: "BULK25",
      validUntil: "2024-05-15",
      category: "Dairy",
      discount: "25%"
    },
    {
      title: "Senior Citizen Special",
      description: "10% off for senior citizens on all orders",
      code: "SENIOR10",
      validUntil: "2024-12-31",
      category: "All Categories",
      discount: "10%"
    }
  ];

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <div className="bg-green-600 text-white py-6">
        <div className="container mx-auto px-4">
          <Link to="/dashboard" className="inline-flex items-center text-white hover:text-green-100 mb-4">
            <ArrowLeft className="h-5 w-5 mr-2" />
            Back to Dashboard
          </Link>
          <div className="flex items-center">
            <Tag className="h-8 w-8 mr-3" />
            <h1 className="text-3xl font-bold">Current Discounts & Offers</h1>
          </div>
        </div>
      </div>

      {/* Main Content */}
      <div className="container mx-auto px-4 py-8">
        {/* Stats Section */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div className="bg-white rounded-lg shadow-sm p-6">
            <div className="flex items-center">
              <div className="bg-green-100 rounded-full p-3 mr-4">
                <Tag className="h-6 w-6 text-green-600" />
              </div>
              <div>
                <p className="text-gray-500 text-sm">Active Offers</p>
                <p className="text-2xl font-bold">{discounts.length}</p>
              </div>
            </div>
          </div>
          <div className="bg-white rounded-lg shadow-sm p-6">
            <div className="flex items-center">
              <div className="bg-purple-100 rounded-full p-3 mr-4">
                <Percent className="h-6 w-6 text-purple-600" />
              </div>
              <div>
                <p className="text-gray-500 text-sm">Maximum Savings</p>
                <p className="text-2xl font-bold">25%</p>
              </div>
            </div>
          </div>
          <div className="bg-white rounded-lg shadow-sm p-6">
            <div className="flex items-center">
              <div className="bg-blue-100 rounded-full p-3 mr-4">
                <ShoppingBag className="h-6 w-6 text-blue-600" />
              </div>
              <div>
                <p className="text-gray-500 text-sm">Categories</p>
                <p className="text-2xl font-bold">All</p>
              </div>
            </div>
          </div>
        </div>

        {/* Discounts Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
          {discounts.map((discount, index) => (
            <div key={index} className="bg-white rounded-lg shadow-sm overflow-hidden">
              <div className="p-6">
                <div className="flex items-center justify-between mb-4">
                  <h3 className="text-xl font-semibold text-gray-900">{discount.title}</h3>
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                    {discount.discount} OFF
                  </span>
                </div>
                <p className="text-gray-600 mb-4">{discount.description}</p>
                <div className="flex items-center justify-between">
                  <div>
                    <p className="text-sm text-gray-500">Promo Code:</p>
                    <p className="font-mono text-lg font-semibold text-gray-900">{discount.code}</p>
                  </div>
                  <div className="text-right">
                    <p className="text-sm text-gray-500">Valid Until:</p>
                    <div className="flex items-center text-gray-700">
                      <Clock className="h-4 w-4 mr-1" />
                      <span>{discount.validUntil}</span>
                    </div>
                  </div>
                </div>
                <div className="mt-4 pt-4 border-t border-gray-100">
                  <button className="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors">
                    Apply Discount
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}