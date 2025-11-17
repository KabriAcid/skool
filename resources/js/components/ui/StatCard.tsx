import React from 'react'
import Card from './Card'
import Badge from './Badge'
import ProgressBar from './ProgressBar'

interface StatCardProps {
  icon: React.ReactNode
  title: string
  value: string | number
  subtitle?: string
  badgeColor?: 'primary' | 'secondary' | 'success' | 'warning' | 'error'
  showProgress?: boolean
  progressValue?: number
  trend?: {
    label: string
    value: string
    isPositive: boolean
  }
}

const StatCard: React.FC<StatCardProps> = ({
  icon,
  title,
  value,
  subtitle,
  badgeColor = 'primary',
  showProgress = false,
  progressValue = 0,
  trend,
}) => {
  return (
    <Card className="p-3 sm:p-4 lg:p-6" hoverable>
      <div className="flex items-start justify-between gap-3">
        <div className="flex-1">
          <div className="mb-2 flex items-center gap-2">
            <Badge variant={badgeColor} size="md" icon={icon} />
          </div>
          <h3 className="mb-1 text-sm font-medium text-spiritual-600">{title}</h3>
          <p className="text-xl sm:text-2xl lg:text-3xl font-bold text-spiritual-900 truncate">
            {value}
          </p>
          {subtitle && (
            <p className="mt-1 text-xs sm:text-sm text-success-600">{subtitle}</p>
          )}
          {trend && (
            <p className={clsx(
              'mt-2 text-xs sm:text-sm font-medium',
              trend.isPositive ? 'text-success-600' : 'text-error-600'
            )}>
              {trend.isPositive ? '↑' : '↓'} {trend.value} {trend.label}
            </p>
          )}
        </div>
      </div>
      {showProgress && (
        <div className="mt-4">
          <ProgressBar value={progressValue} showLabel={false} />
        </div>
      )}
    </Card>
  )
}

const clsx = (...args: any[]) => args.filter(Boolean).join(' ')

export default StatCard
