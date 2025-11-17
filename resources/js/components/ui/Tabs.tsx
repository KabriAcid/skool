import React, { useState } from 'react'
import clsx from 'clsx'

interface Tab {
  id: string
  label: string
  content: React.ReactNode
  icon?: React.ReactNode
}

interface TabsProps {
  tabs: Tab[]
  defaultTab?: string
}

const Tabs: React.FC<TabsProps> = ({ tabs, defaultTab }) => {
  const [activeTab, setActiveTab] = useState(defaultTab || tabs[0]?.id)

  const activeTabContent = tabs.find((t) => t.id === activeTab)

  return (
    <div className="w-full">
      <div className="flex overflow-x-auto border-b border-spiritual-200">
        {tabs.map((tab) => (
          <button
            key={tab.id}
            onClick={() => setActiveTab(tab.id)}
            className={clsx(
              'flex items-center gap-2 px-4 py-3 text-sm font-medium transition-all duration-300 whitespace-nowrap',
              activeTab === tab.id
                ? 'border-b-2 border-primary-500 text-primary-600'
                : 'text-spiritual-600 hover:text-spiritual-700'
            )}
          >
            {tab.icon && <span>{tab.icon}</span>}
            {tab.label}
          </button>
        ))}
      </div>
      <div className="mt-4">
        {activeTabContent?.content}
      </div>
    </div>
  )
}

export default Tabs
