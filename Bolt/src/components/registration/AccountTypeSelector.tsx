import { motion } from 'framer-motion';
import { User, School } from 'lucide-react';
import type { AccountType } from '../../types/registration';

interface AccountTypeSelectorProps {
  onSelect: (type: AccountType) => void;
}

export default function AccountTypeSelector({ onSelect }: AccountTypeSelectorProps) {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      exit={{ opacity: 0, y: -20 }}
      className="mb-8 space-y-4"
    >
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
        <motion.button
          type="button"
          onClick={() => onSelect('student')}
          whileHover={{ scale: 1.02 }}
          whileTap={{ scale: 0.98 }}
          className="p-4 sm:p-6 border-2 rounded-xl sm:rounded-2xl transition-all duration-300 border-gray-200 hover:border-blue-300 focus:outline-none"
        >
          <User className="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-2 sm:mb-3 text-blue-600" />
          <h3 className="font-bold text-base sm:text-lg text-gray-900">Student</h3>
          <p className="text-xs sm:text-sm text-gray-600 mt-1">Prepare for JAMB, WAEC & NECO</p>
        </motion.button>

        <motion.button
          type="button"
          onClick={() => onSelect('school_admin')}
          whileHover={{ scale: 1.02 }}
          whileTap={{ scale: 0.98 }}
          className="p-4 sm:p-6 border-2 rounded-xl sm:rounded-2xl transition-all duration-300 border-gray-200 hover:border-blue-300 focus:outline-none"
        >
          <School className="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-2 sm:mb-3 text-green-600" />
          <h3 className="font-bold text-base sm:text-lg text-gray-900">School Admin</h3>
          <p className="text-xs sm:text-sm text-gray-600 mt-1">Manage students & assessments</p>
        </motion.button>
      </div>
    </motion.div>
  );
}
