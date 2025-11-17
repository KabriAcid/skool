import React from 'react'
import clsx from 'clsx'

interface CardProps extends React.HTMLAttributes<HTMLDivElement> {
  hoverable?: boolean
  elevated?: boolean
}

const Card = React.forwardRef<HTMLDivElement, CardProps>(
  ({ className, hoverable = false, elevated = false, ...props }, ref) => {
    return (
      <div
        ref={ref}
        className={clsx(
          'rounded-xl sm:rounded-2xl border border-white/20 bg-white/90 backdrop-blur-sm shadow-soft',
          elevated && 'shadow-strong',
          hoverable && 'card-hover transition-all duration-300 hover:shadow-medium',
          className
        )}
        {...props}
      />
    )
  }
)

Card.displayName = 'Card'

export default Card
